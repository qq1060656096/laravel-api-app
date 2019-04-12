<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-11
 * Time: 20:53
 */

namespace App\OAuth2\Grants\Custom;

use App\Exceptions\OAuth2Exception;
use App\Helper\SuiteHelper;
use App\OAuth2\Helper\AuthHelper;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\AbstractGrant;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\RequestEvent;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * 自定义auth grant
 * Class CustomAuthGrant
 * @package App\OAuth2\Grants
 */
class CustomAuthGrant extends AbstractGrant
{
    /**
     * @param UserRepositoryInterface         $userRepository
     * @param RefreshTokenRepositoryInterface $refreshTokenRepository
     * @throws \Exception
     */
    public function __construct(UserRepositoryInterface $userRepository, RefreshTokenRepositoryInterface $refreshTokenRepository)
    {
        $this->setUserRepository($userRepository);
        $this->setRefreshTokenRepository($refreshTokenRepository);
        $this->refreshTokenTTL = new \DateInterval('P1M');
    }


    /**
     * {@inheritdoc}
     */
    public function respondToAccessTokenRequest(ServerRequestInterface $request, ResponseTypeInterface $responseType, \DateInterval $accessTokenTTL)
    {
        // Validate request
        $client = $this->validateClient($request);
        $scopes = $this->validateScopes($this->getRequestParameter('scope', $request));
        $user = $this->validate($request, $client);

        $scopes = $this->scopeRepository->finalizeScopes($scopes, $this->getIdentifier(), $client, $user->getIdentifier());

        // Issue and persist new tokens
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->getIdentifier(), $scopes);
        $refreshToken = $this->issueRefreshToken($accessToken);
        AuthHelper::setAccessToken($accessToken);
        // Inject tokens into response
        $responseType->setAccessToken($accessToken);
        $responseType->setRefreshToken($refreshToken);

        return $responseType;
    }

    protected function validate(ServerRequestInterface $request,  $client)
    {
        $code = $this->getRequestParameter('code', $request);

        if (is_null($code)) {
            throw OAuth2Exception::wxCodeCodeIsEmpty();
        }

        $user = $this->userRepository->getUserEntityByUserCredentials(
            $code,
            null,
            $this->getIdentifier(),
            $client
        );
        if ($user instanceof UserEntityInterface === false) {
            $this->getEmitter()->emit(new RequestEvent(RequestEvent::USER_AUTHENTICATION_FAILED, $request));

            throw OAuthServerException::invalidCredentials();
        }
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return 'custom_code';
    }

    public function saveAccessToken($accessToken)
    {
        $cache = SuiteHelper::getCacheInstance();
        $cache->put('auth_'.$this->getIdentifier().sha1($accessToken), $accessToken);
    }
}