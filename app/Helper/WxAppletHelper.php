<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-12
 * Time: 16:59
 */

namespace App\Helper;


use Zwei\WorkWechat\Cache\AppCacheKey;

class WxAppletHelper
{
    /**
     * 获取缓存实例
     * @return mixed
     */
    public static function getCacheInstance()
    {

        return Cache::store('qywx');
    }


    public static function getAccessTokenCacheKey($platform, $appId)
    {
        $arr = [
            'wx_applet_access_token',
            $platform,
            $appId
        ];
        $key = AppCacheKey::generateKey($arr);
        return $key;
    }

    /**
     * 获取 suite_ticket
     * @param string $appName
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public static function getAccessTokenCache($appName) {
        $key = AppCacheKey::getSuiteAccessTokenCacheKey($appName);
        return self::getCacheInstance()->get($key);
    }



    /**
     * 设置 suite_access_token 第三方应用凭证
     * @param string $appName
     * @param string $suiteAccessToken
     * @param integer $minutes
     * @return mixed
     */
    public static function setSuiteAccessToken($appName, $suiteAccessToken, $minutes = 120) {
        $key = AppCacheKey::getSuiteAccessToken($appName);
        return self::getCacheInstance()->put($key, $suiteAccessToken, $minutes);
    }
}