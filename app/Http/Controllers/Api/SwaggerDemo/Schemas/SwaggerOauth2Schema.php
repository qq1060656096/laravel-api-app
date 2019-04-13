<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 06:22
 */

namespace App\Http\Controllers\Api\SwaggerDemo\Schemas;


/**
 * Class SwaggerOauth2Schema
 * @package App\Http\Controllers\Api\SwaggerDemo\Schemas
 *
 * @OA\Schema(
 *      schema="swagger_oauth2_schema",
 *      description="swagger auth2",
 *      type="object",
 *      required={"user_name", "pass"},
 *      @OA\Property(property="grant_type",type="string",description="模式"),
 *      @OA\Property(property="client_id",type="string",description="client_id, 由服务端分配"),
 *      @OA\Property(property="client_secret",type="string",description="client_secret, 由服务端分配"),
 *      @OA\Property(property="username",type="string",description="用户名（模式为password必填"),
 *      @OA\Property(property="password",type="string",description="用户密码（模式为password必填）"),
 *      @OA\Property(property="login_type",type="string",description="登录类型(模式为 wx_code 必填)[wx_applet_code->维系小程序, wx_qy_wx->企业微信]"),
 *      @OA\Property(property="code",type="string",description="code, 微信code小程序code等(模式为 wx_code 必填)"),
 *      @OA\Property(property="refresh_token",type="string",description="更新令牌，用来获取下一次的访问令牌（模式为 refresh_token 必填）"),
 *  )
 */
class SwaggerOauth2Schema
{


}