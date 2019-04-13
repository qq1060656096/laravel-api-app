<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-12
 * Time: 22:56
 */

namespace App\OAuth2\Users;


use App\Exceptions\OAuth2Exception;
use App\OAuth2\Helper\AuthHelper;

class LoginUser
{
    private $data = [];

    protected $grantType = "";

    protected $accountId = "";

    protected $accountType = "";

    protected $params = [];

    /**
     * 构造方法初始化
     *
     * LoginUser constructor.
     * @param string $grantType
     * @param string $accountId
     * @param string $accountType
     * @param array $params
     */
    public function __construct($grantType, $accountId, $accountType,array $params)
    {
        $this->grantType = $grantType;
        $this->accountId = $accountId;
        $this->accountType = $accountType;
        $this->params = $params;
    }


    /**
     * @return string
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @return string
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }


    /**
     * 生成登录用户信息
     * @return array [$identifier, $loginUserJsonStr]
     */
    public function generateSaveData()
    {
        $arr = [
            $this->grantType,
            $this->accountId,
            $this->accountType,
            $this->params
        ];
        $loginUserJsonStr = json_encode($arr);
        $prefix = sprintf("login_user_%s_%s_", date('Ymd.His'), $this->accountId);
        $identifier = $prefix.sha1($loginUserJsonStr);
        return [$identifier, $loginUserJsonStr];
    }

    /**
     * 保存登录信息(保存登录信息到缓存)
     * @return array [$identifier, $loginUserJsonStr]
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function save()
    {
        list ($identifier, $loginUserJsonStr) = $this->generateSaveData();
        AuthHelper::getCacheInstance()->set($identifier, $loginUserJsonStr, 24 * 3600);
        return [$identifier, $loginUserJsonStr];
    }

    /**
     * 获取登录用户信息(从缓存中获取)
     * @param string $identifier
     * @return LoginUser
     * @throws OAuth2Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function find($identifier)
    {
        $value = AuthHelper::getCacheInstance()->get($identifier);
        if ($value === null) {
            OAuth2Exception::jwtTokenExpired();
        }
        $arr = json_decode($value, true);
        $arrLen = count($arr);
        if ($arrLen != 4) {
            OAuth2Exception::resourceOwnerIdDecodeFailed();
        }
        list($grantType, $accountId, $accountType, $params) = $arr;
        return new LoginUser($grantType, $accountId, $accountType, $params);
    }
}