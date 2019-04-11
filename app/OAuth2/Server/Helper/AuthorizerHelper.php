<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-09
 * Time: 22:23
 */

namespace App\OAuth2\Server\Helper;


use App\Exceptions\OAuth2Exception;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

/**
 * Auth 助手类
 * Class AuthorizerHelper
 * @package App\OAuth2\Server\Helper
 */
class AuthorizerHelper implements AccountTypeInterface
{

    /**
     * 获取资源拥有者id
     */
    public static function getResourceOwnerId()
    {
        $token = Authorizer::getAccessToken();
        return $token->getId();
    }

    /**
     * 获取加密码后的资源拥有者信息
     * @return [$accountId, $accountType, $grantType, $params]
     * @throws OAuth2Exception
     */
    public static function getDecodeResourceOwnerIdArray()
    {
        return self::decodeResourceOwnerId(self::getResourceOwnerId());
    }

    /**
     * @param string $accountId 账户id
     * @param string $accountType 账户类型
     * @param string $grantType 授权类型
     * @param array $params 额外参数
     * @return string
     */
    public static function generateEncodeResourceOwnerId($accountId, $accountType, $grantType, $params = [])
    {
        $arr = [$accountId, $accountType, $grantType, $params];
        return urlencode(base64_encode(json_encode($arr)));
    }

    /**
     * 解析资源拥有者
     * @param $resourceOwnerId
     * @throws OAuth2Exception
     * @return [$accountId, $accountType, $grantType, $params]
     */
    public static function decodeResourceOwnerId($resourceOwnerId)
    {
        $arr = json_decode(base64_decode(urldecode($resourceOwnerId)), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            OAuth2Exception::resourceOwnerIdDecodeFailed();
        }
        return $arr;
    }
}