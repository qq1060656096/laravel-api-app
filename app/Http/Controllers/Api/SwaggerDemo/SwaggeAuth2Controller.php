<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 06:25
 */

namespace App\Http\Controllers\Api\SwaggerDemo;


class SwaggeAuth2Controller
{


    /**
     * @OA\Post(
     *     path="/oauth/token",
     *     tags={"OAuth2"},
     *     summary="",
     *     description="获取令牌及刷新令牌",
     *     operationId="获取令牌及刷新令牌",
     *     deprecated=false,
     *     security={{"oauth2": {"scope"}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  ref="#/components/schemas/swagger_oauth2_schema"
     *              )
     *        )
     *    ),
     *     @OA\Response(
     *          response=400,
     *          ref="#/components/responses/response_400",
     *     ),
     *     @OA\Response(
     *          response=401,
     *          ref="#/components/responses/response_401",
     *     ),
     *     @OA\Response(
     *          response=404,
     *          ref="#/components/responses/response_404",
     *     ),
     *     @OA\Response(
     *          response=422,
     *          ref="#/components/responses/response_422",
     *     ),
     *     @OA\Response(
     *          response=429,
     *          ref="#/components/responses/response_429",
     *     ),
     *     @OA\Response(
     *          response=500,
     *          ref="#/components/responses/response_500",
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  schema="UpdateItem",
     *                  allOf={
     *                      @OA\Schema(ref="#/components/schemas/response_schema"),
     *                      @OA\Schema(
     *                          @OA\Property(property="data", ref="#/components/schemas/swagger_user_schema")
     *                      )
     *                  }
     *              )
     *          ),
     *      ),
     * )
     */
    public function postFormData()
    {

    }


}