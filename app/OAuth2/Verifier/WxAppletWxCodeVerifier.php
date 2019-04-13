<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-13
 * Time: 09:36
 */

namespace App\OAuth2\Verifier;


use App\OAuth2\Helper\AuthHelper;
use App\OAuth2\Users\LoginUser;
use App\OAuth2\Users\WxCodeAuthUser;

/**
 * 小程序登录验证
 * Class WxAppletWxCodeVerifier
 * @package App\OAuth2\Verifier
 */
class WxAppletWxCodeVerifier implements WxCodeVerify
{
    /**
     * 登录验证
     *
     * @param string $grantType
     * @param string $loginType
     * @param string $code
     * @return Illuminate\Contracts\Auth\Authenticatable|null
     * @throws
     */
    public function loginVerify($grantType, $loginType, $code)
    {
        $accountId  = $code;
        $accountType = AuthHelper::ACCOUNT_TYPE_DEFAULT;
        $params     = [];
        $loginUser  = new LoginUser($grantType, $accountId, $accountType, $params);
        list($identifier, $loginUserJsonStr) = $loginUser->save();
        $obj        = new WxCodeAuthUser();
        $obj->setAuthIdentifier($identifier);
        return $obj;
    }

}