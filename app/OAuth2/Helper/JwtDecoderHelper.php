<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-12
 * Time: 09:48
 */

namespace App\OAuth2\Helper;


use App\Exceptions\OAuth2Exception;

class JwtDecoderHelper
{
    public static function decode($jwtToken)
    {
        if ($jwtToken) {
            $jwt = list($header, $claims, $signature) = explode('.', $jwtToken);

            $header = self::decodeFragment($header);
            $claims = self::decodeFragment($claims);
            $signature = (string) base64_decode($signature);

            return [
                'header' => $header,
                'claims' => $claims,
                'signature' => $signature
            ];
        }

        return false;
    }

    protected static function decodeFragment($value)
    {
        return (array) json_decode(base64_decode($value));
    }

    /**
     * 验证 token 是否过期
     * @param arrau $jwtDecodeArray
     * @return bool
     * @throws OAuth2Exception
     */
    public static function checkExpired($jwtDecodeArray)
    {
        if (isset($jwtDecodeArray['claims']['exp']) && $jwtDecodeArray['claims']['exp'] > time()) {
            return true;
        }
        OAuth2Exception::jwtTokenExpired();
    }

    /**
     * @param array $jwtDecodeArray
     * @return bool
     */
    public static function getClientId($jwtDecodeArray)
    {
        if (isset($jwtDecodeArray['claims']['aud'])) {
            return $jwtDecodeArray['claims']['aud'];
        }
        return false;
    }

    /**
     * @param array $jwtDecodeArray
     * @return bool
     */
    public static function getTokenAccessToken($jwtDecodeArray)
    {
        if (isset($jwtDecodeArray['claims']['jti'])) {
            return $jwtDecodeArray['claims']['jti'];
        }
        return false;
    }

    /**
     * @param arra $jwtDecodeArray
     * @return bool
     */
    public static function getUserIdentifier($jwtDecodeArray)
    {
        if (isset($jwtDecodeArray['claims']['sub'])) {
            return $jwtDecodeArray['claims']['sub'];
        }
        return false;
    }
}