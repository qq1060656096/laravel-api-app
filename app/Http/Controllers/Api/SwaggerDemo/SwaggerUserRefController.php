<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 06:25
 */

namespace App\Http\Controllers\Api\SwaggerDemo;

/**
 * Class SwaggerUserRefController
 * @package App\Http\Controllers\Api\SwaggerDemo
 */
class SwaggerUserRefController
{
    /**
     * @param $uid
     * @OA\Get(
     *      path="/swagger-user-ref/{uid}",
     *      operationId="getDemoUser",
     *      tags={"swagger用户ref"},
     *      summary="获取用户详情",
     *      description="获取用户详情",
     *      @OA\Parameter(
     *          ref="#/components/parameters/uid"
     *      ),@OA\Parameter(
     *         name="is_del",
     *         required=true,
     *         in="query",
     *         description="用户是否删除:[1->获取删除用户,0->获取正常用户]",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
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
     *                          @OA\Property(property="data", ref="#/components/schemas/swagger_user_raw_schema")
     *                      )
     *                  }
     *              )
     *          ),
     *      ),
     * )
     */
    public function get($uid)
    {

    }

    /**
     * @OA\Post(
     *     path="/swagger-user-ref/post-json",
     *     tags={"swagger用户ref"},
     *     summary="创建用户",
     *     description="创建用户",
     *     operationId="postDemoUser",
     *     deprecated=false,
     *     security={{"oauth2": {"scope"}}},
     *     @OA\RequestBody(
     *          required=true,
     *          description="swagger_user_request",
     *          @OA\JsonContent(ref="#/components/schemas/swagger_user_raw_schema")
     *      ),
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
     *                          @OA\Property(property="data", ref="#/components/schemas/swagger_user_raw_schema")
     *                      )
     *                  }
     *              )
     *          ),
     *      ),
     * )
     */
    public function postJson()
    {

    }

    /**
     * @OA\Post(
     *     path="/swagger-user-ref/post-form-data",
     *     tags={"swagger用户ref"},
     *     summary="创建用户",
     *     description="创建用户",
     *     operationId="postDemoUser",
     *     deprecated=false,
     *     security={{"oauth2": {"scope"}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *                  ref="#/components/schemas/swagger_user_raw_schema"
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
     *                          @OA\Property(property="data", ref="#/components/schemas/swagger_user_raw_schema")
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

    /**
     * @OA\Delete(
     *      path="/swagger-user-ref/{uid}",
     *      operationId="getDemoUser",
     *      tags={"swagger用户ref"},
     *      summary="删除用户",
     *      description="删除用户",
     *      @OA\Parameter(
     *          ref="#/components/parameters/uid"
     *      ),
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
     *                  }
     *              )
     *          ),
     *      ),
     * )
     */
    public function delete()
    {

    }
}