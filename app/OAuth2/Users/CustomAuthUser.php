<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-11
 * Time: 20:31
 */

namespace App\OAuth2\Users;


use App\OAuth2\Helper\AuthHelper;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * 自定义AuthUser
 * Class CustomAuthUser
 * @package App\OAuth2\Users
 */
class CustomAuthUser implements Authenticatable
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
     * @param string $grantType 授权类型
     * @param string $code 微信Code
     * @return CustomAuthUser
     */
    public function findWxCode($grantType, $code)
    {
        $accountId = $code;
        $accountType = AuthHelper::ACCOUNT_TYPE_DEFAULT;
        $params = [];
        $identifier = AuthHelper::generateEncodeResourceOwnerId($grantType, $accountId, $accountType, $params);
        $obj = new CustomAuthUser();
        $obj->setAuthIdentifier($identifier);
        return $obj;
    }
}