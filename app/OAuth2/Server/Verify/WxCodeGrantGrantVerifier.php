<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-08
 * Time: 22:49
 */

namespace App\OAuth2\Server\Verify;


use App\Exceptions\OAuth2Exception;
use App\OAuth2\Server\Grant\WxCodeGrant;
use App\OAuth2\Server\Helper\AuthorizerHelper;
use App\User;
use League\OAuth2\Server\Grant\AbstractGrant;

class WxCodeGrantGrantVerifier implements CodeGrantVerifierInterface
{
    /**
     * @inheritdoc
     */
    public function verify(AbstractGrant $grantInstance, $code)
    {
        $user = new User();
        $userInfo = $user->where('name', $code)->first();
        if (!$userInfo) {
            OAuth2Exception::wxCodeOpenIdNotFound();
        }
        $grant = new WxCodeGrant();
        return AuthorizerHelper::generateEncodeResourceOwnerId($userInfo->id, AuthorizerHelper::ACCOUNT_TYPE_DEFAULT, $grantInstance->getIdentifier());
    }
}