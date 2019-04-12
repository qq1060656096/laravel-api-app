<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 23:32
 */

namespace App\Exceptions;


use League\OAuth2\Server\Exception\OAuthServerException;

class OAuth2Exception extends OAuthServerException implements AppErrorCodeException
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $this->message = $message;
        $this->code = $code;
    }

    /**
     * client id 没有找到
     * @throws OAuth2Exception
     */
    public static function clientIdNotFound()
    {
        $message = trans("auth.client_secret_not_found");
        throw new OAuth2Exception($message, self::CLIENT_ID_NOT_FOUND);
    }

    /**
     * client id 是空
     * @throws OAuth2Exception
     */
    public static function clientIdIsEmpty()
    {
        $message = trans("auth.client_id_is_empty");
        throw new OAuth2Exception($message, self::CLIENT_ID_IS_EMPTY);
    }

    /**
     * client secret 没有找到
     * @throws OAuth2Exception
     */
    public static function clientSecretNotFound()
    {
        $message = trans("auth.wx_code.open_id_not_found");
        throw new OAuth2Exception($message, self::CLIENT_SECRET_NOT_FOUND);
    }

    /**
     * client secret 是空
     * @throws OAuth2Exception
     */
    public static function clientSecretIsEmpty()
    {
        $message = trans("auth.client_secret_is_empty");
        throw new OAuth2Exception($message, self::CLIENT_SECRET_IS_EMPTY);
    }

    /**
     * 客户端身份验证失败
     * @throws OAuth2Exception
     */
    public static function clientAuthenticationFailed()
    {
        $message = trans("auth.client_authentication_failed");
        throw new OAuth2Exception($message, self::CLIENT_AUTHENTICATION_FAILED);
    }

    /**
     * token过期
     * @throws OAuth2Exception
     */
    public static function jwtTokenExpired()
    {
        $message = trans("auth.jwt_token_expired");
        throw new OAuth2Exception($message, self::JWT_TOKEN_EXPIRED);
    }

    /**
     * 资源解析失败
     * @throws OAuth2Exception
     */
    public static function resourceOwnerIdDecodeFailed()
    {
        $message = trans("auth.resource_owner_id_decode_failed");
        throw new OAuth2Exception($message, self::CLIENT_AUTHENTICATION_FAILED);
    }

    /**
     * 微信code 是空
     * @throws OAuth2Exception
     */
    public static function wxCodeCodeIsEmpty()
    {
        $message = trans("auth.wx_code.code_is_empty");
        throw new OAuth2Exception($message, self::WX_CODE_CODE_IS_EMPTY);
    }

    /**
     * 微信code授权时, 没有找到Open id
     * @throws OAuth2Exception
     */
    public static function wxCodeOpenIdNotFound()
    {
        $message = trans("auth.wx_code.open_id_not_found");
        throw new OAuth2Exception($message, self::WX_CODE_OPENID_NOT_FOUND);
    }
}