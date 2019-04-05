<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 06:50
 */

namespace App\Http\Controllers\Api\SwaggerDemo\Schemas;

/**
 * Class ResponseSchema
 * @package App\Http\Controllers\Api\SwaggerDemo\Schemas
 * @OA\Schema(
 *      schema="response_schema",
 *      @OA\Property(property="status",type="string",description="状态: [T->成功, F->失败]"),
 *      @OA\Property(property="message",type="string",description="接口消息"),
 *      @OA\Property(property="code",type="string",description="错误码"),
 *      @OA\Property(property="data",type="object",description="数据"),
 * ),
 */
class ResponseSchema
{

}