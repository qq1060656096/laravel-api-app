<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-13
 * Time: 09:37
 */

namespace App\OAuth2\Verifier;


interface WxCodeVerify
{
    /**
     * 登录验证
     *
     * @param string $grantType
     * @param string $loginType
     * @param string $code
     * @return Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function loginVerify($grantType, $loginType, $code);
}