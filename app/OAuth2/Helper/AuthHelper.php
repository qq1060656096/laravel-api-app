<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-09
 * Time: 22:23
 */

namespace App\OAuth2\Helper;


use App\Exceptions\OAuth2Exception;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Psr\SimpleCache\CacheInterface;
use Zwei\WorkWechat\Helpers\SuiteHelper;

/**
 * Auth 助手类
 * Class AuthorizerHelper
 * @package App\OAuth2\Server\Helper
 */
class AuthHelper implements AccountTypeInterface
{

    /**
     * 获取资源拥有者id
     */
    public static function getId()
    {
        return auth()->id();
    }

    /**
     * 获取用户信息
     *
     * @return mixed
     * @throws OAuth2Exception
     */
    public static function getUserArr()
    {
        return self::decodeResourceOwnerId(auth()->id());
    }

    /**
     * 获取加密码后的资源拥有者信息
     * @return [$accountId, $accountType, $grantType, $params]
     * @throws OAuth2Exception
     */
    public static function getDecodeResourceOwnerIdArray()
    {
        return self::decodeResourceOwnerId(self::getId());
    }

    /**
     * 生成验
     *
     * @param string $grantType 授权类型
     * @param string $accountId 账户id
     * @param string $accountType 账户类型
     * @param array $params 额外参数
     * @return string
     */
    public static function generateEncodeResourceOwnerId($grantType, $accountId, $accountType, $params = [])
    {
        $arr = [$grantType, $accountId, $accountType, $params];
        $checkCode = self::getCheckCode($arr);
        $arr[] = $checkCode;
        return encrypt(json_encode($arr));
    }

    /**
     * 解析资源拥有者
     * @param $resourceOwnerId
     * @throws OAuth2Exception
     * @return [$grantType, $accountId, $accountType, $params]
     */
    public static function decodeResourceOwnerId($resourceOwnerId)
    {
        // 1. 解码
        // 2. 检测是否解码失败
        // 3. 验证解码出来数组长度不是5
        // 4. 验证解码出来的效验码是否正确
        $arr = json_decode(decrypt($resourceOwnerId), true);
        $arrLen = count($arr);
        if (json_last_error() !== JSON_ERROR_NONE) {
            OAuth2Exception::resourceOwnerIdDecodeFailed();
        }
        if ($arrLen != 5) {
            OAuth2Exception::resourceOwnerIdDecodeFailed();
        }
        $arrLastIndex = $arrLen-1;
        $checkCode = $arr[$arrLastIndex];
        unset($arr[$arrLastIndex]);
        if ($checkCode != self::getCheckCode($arr)) {
            OAuth2Exception::resourceOwnerIdDecodeFailed();
        }
        return $arr;
    }

    /**
     * 获取校验码
     *
     * @param string $arr
     * @return string
     */
    public static function getCheckCode($arr)
    {
        $checkCode = sha1(json_encode($arr).env('APP_KEY'));
        return $checkCode;
    }

    public static function getAccessTokenCacheKey($accessToken)
    {
        $arr = [
            'auth',
            sha1($accessToken),
        ];
        return SuiteHelper::arrayToKey($arr);
    }

    public static function setAccessToken($accessToken)
    {
//        var_dump($accessToken);exit;
        $cache = \App\Helper\SuiteHelper::getCacheInstance();
//        $cache->put(self::getAccessTokenCacheKey($accessToken), $accessToken);
    }

    public static function getAccessToken($accessToken)
    {
        $cache = \App\Helper\SuiteHelper::getCacheInstance();
        return $cache->get(self::getAccessTokenCacheKey($accessToken));
    }

    /**
     * 获取缓存实例
     * @return CacheInterface
     */
    public static function getCacheInstance()
    {
        return Cache::store('business-card');
    }

    public static function saveLoginUser($grantType, $accountId, $accountType, $params = [])
    {
        $arr = [$grantType, $accountId, $accountType, $params];
        json_encode($arr);
    }
}