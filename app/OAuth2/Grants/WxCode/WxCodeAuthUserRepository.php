<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-11
 * Time: 20:59
 */

namespace App\OAuth2\Grants\WxCode;


use App\OAuth2\Helper\AuthHelper;
use App\OAuth2\Users\CustomAuthUser;
use http\Exception\RuntimeException;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Laravel\Passport\Bridge\User as UserEntity;

class WxCodeAuthUserRepository implements UserRepositoryInterface
{
    /**
     * 获取用户
     *
     * Get a user entity.
     *
     * @param string                $username
     * @param string                $password
     * @param string                $grantType    The grant type used
     * @param ClientEntityInterface $clientEntity
     *
     * @return UserEntityInterface
     */
    public function getUserEntityByUserCredentials($username, $password, $grantType, ClientEntityInterface $clientEntity)
    {
        $provider = config('auth.guards.api.provider');

        if (is_null($model = config("auth.providers.{$provider}.model"))) {
            throw new RuntimeException('Unable to determine authentication model from configuration.');
        }

        if (method_exists($model, 'findWxCode')) {
            $user = (new $model)->findWxCode($grantType, $username);
        }

        if (is_null($user)) {
            return;
        }
        return new UserEntity($user->getAuthIdentifier());
    }
}
