<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-11
 * Time: 20:31
 */

namespace App\OAuth2\Users;


use App\Exceptions\OAuth2Exception;
use App\OAuth2\Helper\AuthHelper;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * 微信code AuthUser
 * Class WxCodeAuthUser
 * @package App\OAuth2\Users
 */
class WxCodeAuthUser implements Authenticatable
{


    protected $identityName = "id";

    /**
     * @var string
     */
    protected $password = "";

    /**
     * @var string
     */
    protected $rememberToken = "";

    /**
     * @var string
     */
    protected $rememberTokenName = "";

    /**
     * 登录用户信息
     * @var LoginUser|null
     */
    protected $loginUser = null;

    /**
     * @inheritdoc
     */
    public function getAuthIdentifierName()
    {
        return $this->identityName;
    }

    /**
     * @inheritdoc
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * @inheritdoc
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * @inheritdoc
     */
    public function setRememberToken($value)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getRememberTokenName()
    {
        return $this->rememberTokenName;
    }


    /**
     * 设置身份标识符
     * @param $identifier
     */
    public function setAuthIdentifier($identifier)
    {
        $this->{$this->getAuthIdentifierName()} = $identifier;
    }

    /**
     * 设置密码
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return LoginUser|null
     */
    public function getLoginUser(): LoginUser
    {
        return $this->loginUser;
    }

    /**
     * @param LoginUser|null $loginUser
     */
    public function setLoginUser(LoginUser $loginUser)
    {
        $this->loginUser = $loginUser;
    }


    /**
     *
     * 登录
     *
     * @param string $grantType 授权类型
     * @return WxCodeAuthUser
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function login($grantType)
    {
        $code = request()->input('code');
        $loginType = request()->input("login_type");
        $loginTypeConfig  = config('auth_wx_code.'.$loginType);
        // 没有配置
        if (!$loginTypeConfig) {
            OAuth2Exception::wxCodeLoginTypeConfigNotFound();
        }
        // 获取验证者类
        if (!isset($loginTypeConfig['verifier'])) {
            OAuth2Exception::wxCodeLoginTypeConfig();
        }
        $codeVerifierclass = $loginTypeConfig['verifier'];
        $obj = new $codeVerifierclass();
        return $obj->loginVerify($grantType, $loginType, $code);
        return $obj;
    }

}