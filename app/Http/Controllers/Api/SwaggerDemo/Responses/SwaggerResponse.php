<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 07:08
 */

namespace App\Http\Controllers\Api\SwaggerDemo\Responses;

/**
 * Class SwaggerResponse
 * @package App\Http\Controllers\Api\SwaggerDemo\Response
 *
 * @OA\Response(
 *   response="response_400",
 *   description="请求错误",
 *      @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  schema="UpdateItem",
 *                  allOf={
 *                      @OA\Schema(ref="#/components/schemas/response_schema"),
 *                  }
 *              )
 *          ),
 *      ),
 * )
 *
 * @OA\Response(
 *   response="response_401",
 *   description="用户未授权",
 *      @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  schema="UpdateItem",
 *                  allOf={
 *                      @OA\Schema(ref="#/components/schemas/response_schema"),
 *                  }
 *              )
 *          ),
 *      ),
 * )
 *
 * @OA\Response(
 *   response="response_404",
 *   description="页面不存在",
 *    @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  schema="UpdateItem",
 *                  allOf={
 *                      @OA\Schema(ref="#/components/schemas/response_schema"),
 *                  }
 *              )
 *          ),
 *      ),
 * )
 *
 * @OA\Response(
 *   response="response_422",
 *   description="Unprocesable entity - [POST/PUT/PATCH] 当创建一个对象时，发生一个验证错误。",
 *    @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  schema="UpdateItem",
 *                  allOf={
 *                      @OA\Schema(ref="#/components/schemas/response_schema"),
 *                  }
 *              )
 *          ),
 *      ),
 * )
 *
 *  @OA\Response(
 *   response="response_429",
 *   description="Too Many Requests - [*] : 用户在给定的时间内发送了太多的请求",
 *    @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  schema="UpdateItem",
 *                  allOf={
 *                      @OA\Schema(ref="#/components/schemas/response_schema"),
 *                  }
 *              )
 *          ),
 *      ),
 * )
 *
 * @OA\Response(
 *   response="response_500",
 *   description="INTERNAL SERVER ERROR - [*]：服务器发生错误，用户将无法判断发出的请求是否成功",
 *    @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  schema="UpdateItem",
 *                  allOf={
 *                      @OA\Schema(ref="#/components/schemas/response_schema"),
 *                  }
 *              )
 *          ),
 *      ),
 * )
 */
class SwaggerResponse
{

}