<?php
namespace App\Helper;

use App\Models\QywxBindModel;
use App\Models\QywxSuiteModel;
use Illuminate\Support\Facades\Cache;
use Zwei\WorkWechat\Cache\AppCacheKey;
use Zwei\WorkWechat\JsSdk\JsSdkApi;
use Zwei\WorkWechat\Suite;
use Zwei\WorkWechat\Suites\SuiteApi;
use spec\PhpSpec\Formatter\Presenter\Exception\TaggingExceptionElementPresenterSpec;

// https://laravel-china.org/docs/laravel/5.5/cache/1060

class SuiteHelper
{
    /**
     * 获取缓存实例
     * @return mixed
     */
    public static function getCacheInstance()
    {

        return Cache::store('qywx');
    }

    /**
     * 设置 suite_ticket
     * @param string $appName
     * @param string $suiteTicket
     * @param float|integer $minutes
     * @return mixed
     */
    public static function setSuiteTicket($appName, $suiteTicket, $minutes = 100) {
        $key = AppCacheKey::getSuiteTicket($appName);
        return self::getCacheInstance()->put($key, $suiteTicket, $minutes);
    }

    /**
     * 获取 suite_ticket
     * @param string $appName
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public static function getSuiteTicket($appName) {
        $key = AppCacheKey::getSuiteTicket($appName);
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

    /**
     * 获取第三方应用凭证
     *
     * 如果缓存有就直接返回
     * 没有就去企业微信拉取
     *
     * @param string $appName
     * @return string
     * @throws \Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException
     */
    public static function getSuiteAccessToken($appName) {
        $key = AppCacheKey::getSuiteAccessToken($appName);
        $suiteAccessToken = self::getCacheInstance()->get($key);
        // 如果有就直接返回$suiteAccessToken
        if ($suiteAccessToken) {
            return $suiteAccessToken;
        }
        $appInfo        = self::getAppInfo($appName);
        $suiteId        = $appInfo['suite_id'];
        $suiteSecret    = $appInfo['secret'];
        $suiteTicket    = self::getSuiteTicket($appName);
        $suite          = new SuiteApi();
        $result         = $suite->getSuiteAccessToken($suiteId, $suiteSecret, $suiteTicket);
        // 设置 $suiteAccessToken 到缓存中
        self::setSuiteAccessToken($appName, $result['suite_access_token'], ($result['expires_in']-200)/60);
        return $result['suite_access_token'];
    }

    /**
     * 获取企业access_token
     *
     * @param string $appName 应用名(唯一)
     * @return string
     */
    public static function getCorpAccessTokenKey($appName, $corpId) {
        $key = [
            AppCacheKey::getCacheKeyPrefix(),
            $appName,
            'corp_access_token',
            $corpId
        ];
        return AppCacheKey::generateKey($key);
    }


    /**
     * 获取企业 access_token
     *
     * @param string $appName
     * @param string $corpId
     * @param string $suiteAccessToken
     * @param string $permanentCode
     * @return mixed
     * @throws \Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException
     */
    public static function getCorpAccessToken($appName, $corpId, $suiteAccessToken, $permanentCode) {
        $key = self::getCorpAccessTokenKey($appName, $corpId);
        $value = self::getCacheInstance()->get($key);
        // 如果有就直接返回
        if ($value) {
            return $value;
        }
        $suite  = new SuiteApi();
        $result = $suite->getCorpToken($suiteAccessToken, $corpId, $permanentCode);
        self::getCacheInstance()->put($key, $result['access_token'], ($result['expires_in']-200)/60);
        return $result['access_token'];
    }


    /**
     * 获取永久授权码key
     * @param string $appName 应用
     * @param string $corpId 授权企业微信corpId
     * @return string
     */
    public static function getPermanentCodeKey($appName, $corpId) {
        $key = [
            AppCacheKey::getCacheKeyPrefix(),
            $appName,
            'permanent_code',
            $corpId
        ];
        return AppCacheKey::generateKey($key);
    }
    /**
     * 获取 permanent_code 永久授权码
     * @param string $appName 应用
     * @param string $corpId 授权企业微信corpId
     * @return string
     */
    public static function getPermanentCode($appName, $corpId) {
        $key = self::getPermanentCodeKey($appName, $corpId);
        $value = self::getCacheInstance()->get($key);
        // 如果有就直接返回
        if ($value) {
            return $value;
        }
        $appInfo = self::getAppInfo($appName);
        $model = QywxBindModel::getAppBindByCorpId($appInfo['app_id'], $corpId);
        self::getCacheInstance()->put($key, $model->permanent_code, 60000);
        return $model->permanent_code;
    }

    /**
     * 設置永久授权码
     * @param string $appName
     * @param string $corpId
     * @param string $permanentCode
     * @param int $minutes
     * @return mixed
     */
    public static function setPermanentCode($appName, $corpId, $permanentCode, $minutes = 60000)
    {
        $key = self::getPermanentCodeKey($appName, $corpId);
        return self::getCacheInstance()->put($key, $permanentCode, $minutes);
    }

    /**
     * 获取应用缓存键
     * @param $appName
     * @return array|string
     */
    public static function getAppInfoCacheKey($appName)
    {
        $key = [
            AppCacheKey::getCacheKeyPrefix(),
            $appName,
            'app_info'
        ];
        $key = AppCacheKey::generateKey($key);
        return $key;
    }

    /**
     * 获取应用信息
     *
     * @param $appName
     * @return mixed
     */
    public static function getAppInfo($appName)
    {
        $key = self::getAppInfoCacheKey($appName);
        $value = self::getCacheInstance()->get($key);
        // 如果有就直接返回$suiteAccessToken
        if ($value) {
            $appInfoArr = json_decode($value, true);
            return $appInfoArr;
        }
        $appInfo = QywxSuiteModel::getAppInfoByName($appName);
        $appInfoJson = $appInfo->toJson();
        $appInfoArr = $appInfo->toArray();
        self::getCacheInstance()->put($key, $appInfoJson, 600);
        return $appInfoArr;
    }

    /**
     * 设置jsapi_ticket
     * @param  string     $appName     应用名（唯一—）
     * @param string $corpId
     * @param  string     $jsApiTicket jsapi_ticket
     * @param  integer    $minutes     缓存时间
     * @author maofei
     * @since  2018-09-03
     * @return string
     */
    public static function setJsApiTicket($appName, $corpId, $jsApiTicket, $minutes = 120)
    {
        $key = self::getJsApiTicketCacheKey($appName, $corpId);
        return self::getCacheInstance()->put($key, $jsApiTicket, $minutes);
    }

    /**
     * 获取应用缓存键
     * @param string $appName
     * @param string $corpId
     * @return array|string
     */
    public static function getJsApiTicketCacheKey($appName, $corpId)
    {
        $key = [
            AppCacheKey::getCacheKeyPrefix(),
            $appName,
            'jsapi_ticket',
            $corpId
        ];
        $key = AppCacheKey::generateKey($key);
        return $key;
    }

    /**
     * 获取jsapi_ticket的值
     * @param  string     $appName     应用名（唯一—）
     * @return string
     * @author maofei
     * @since  2018-09-03
     */
    public static function getJsApiTicket($appName, $corpId)
    {
        $key = self::getJsApiTicketCacheKey($appName, $corpId);
        $value = self::getCacheInstance()->get($key);
        if ($value){
            return $value;
        }
        $appInfo = self::getAppInfo($appName);
        $qywxBind = (new QywxBindModel())
            ->where('app_id', $appInfo['app_id'])
            ->where('corpid', $corpId)
            ->first();
        $suiteAccessToken = self::getSuiteAccessToken($appName);
        $corpAccessToken = self::getCorpAccessToken($appName, $qywxBind['corpid'], $suiteAccessToken, $qywxBind['permanent_code']);
        $suite = new JsSdkApi();
        $jsApiTicket = $suite->getJsApiTicket($corpAccessToken);
        self::setJsApiTicket($appName, $corpId, $jsApiTicket['ticket'], ($jsApiTicket['expires_in']-200)/60);
        return $jsApiTicket['ticket'];
    }

    /**
     * 清空所有缓存
     */
    public static function clearAllCache($appName, $corpId)
    {
        $keysArr[] = self::getAppInfoCacheKey($appName);
        $keysArr[] = self::getJsApiTicketCacheKey($appName, $corpId);
        $keysArr[] = self::getPermanentCodeKey($appName, $corpId);
        $keysArr[] = self::getCorpAccessTokenKey($appName, $corpId);
        $keysArr[] = AppCacheKey::getSuiteAccessToken($appName);
        $keysArr[] = AppCacheKey::getSuiteTicket($appName);
        foreach ($keysArr as $key) {
            self::getCacheInstance()->forget($key);
        }
    }

    /**
     * 企业微信企业取消授权清空缓存
     */
    public static function cancelAuthClearAllCache($appName, $corpId)
    {
        $keysArr[] = self::getJsApiTicketCacheKey($appName, $corpId);
        $keysArr[] = self::getPermanentCodeKey($appName, $corpId);
        $keysArr[] = self::getCorpAccessTokenKey($appName, $corpId);
        foreach ($keysArr as $key) {
            self::getCacheInstance()->forget($key);
        }
    }
}