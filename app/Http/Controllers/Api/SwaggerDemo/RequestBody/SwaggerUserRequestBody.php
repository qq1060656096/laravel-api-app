<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 06:22
 */

namespace App\Http\Controllers\Api\SwaggerDemo\RequestBody;


/**
 * Class SwaggerUser
 * @package App\Http\Controllers\Api\SwaggerDemo\RequestBody
 * @OA\RequestBody(
 *   request="swagger_user_request_body",
 *   required=true,
 *   description="swagger_user_request",
 *   @OA\JsonContent(ref="#/components/schemas/swagger_user_schema")
 * )
 */
class SwaggerUserRequestBody
{

}