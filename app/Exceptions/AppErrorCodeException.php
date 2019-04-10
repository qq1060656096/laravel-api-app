<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-09
 * Time: 08:06
 */

namespace App\Exceptions;


interface AppErrorCodeException
{
    /**
     * client_id不存在
     */
    const CLIENT_ID_NOT_FOUND = '4010001';
    /**
     * client_id不能为空
     */
    const CLIENT_ID_IS_EMPTY = '4010002';
    /**
     * client_secret 不存在
     */
    const CLIENT_SECRET_NOT_FOUND = '4010003';

    /**
     * 客户端身份验证失败
     */
    const CLIENT_AUTHENTICATION_FAILED = '4010004';

    /**
     * 资源拥有者解析失败
     */
    const RESOURCE_OWNER_ID_DECODE_FAILED = '4010010';

    /**
     * client_secret 不能为空
     */
    const CLIENT_SECRET_IS_EMPTY = '4010004';

    /**
     * 微信code授权时 code不能未空
     */
    const WX_CODE_CODE_IS_EMPTY = "4010100";

    /**
     * 微信code授权时没有找到open_id
     */
    const WX_CODE_OPENID_NOT_FOUND = "4010101";

}