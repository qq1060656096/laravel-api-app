<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @param ApiResponse $response
     *
     * @OA\Get(
     *      path="/api/v1/user",
     *      tags={"用户"},
     *      summary="获取用户基本信息",
     *      description="获取用户基本信息",
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
     *                          @OA\Property(property="data", ref="#/components/schemas/user_base_info_schema")
     *                      )
     *                  }
     *              )
     *          ),
     *      ),
     * )
     */
    public function getUserBaseInfo(ApiResponse $response)
    {

    }

    /**
     * @param ApiResponse $response
     *
     * @OA\Post(
     *      path="/api/v1/user",
     *      tags={"用户"},
     *      summary="编辑用户基本信息",
     *      description="编辑用户基本信息",
     *     @OA\RequestBody(
     *          required=true,
     *          description="swagger_user_request",
     *          @OA\JsonContent(ref="#/components/schemas/user_base_info_schema")
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
     *                      )
     *                  }
     *              )
     *          ),
     *      ),
     * )
     */
    public function postUserBaseInfo(ApiResponse $response)
    {

    }
}
