<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 06:25
 */

namespace App\Http\Controllers\Api\SwaggerDemo;


class SwaggerUserController
{
    /**
     * @param $uid
     * @OA\Get(
     *      path="/swagger-user/{uid}",
     *      operationId="getDemoUser",
     *      tags={"swagger用户"},
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
     *                          @OA\Property(property="data",
     *                              @OA\Property(property="user_name",type="string",description="用户名"),
     *                              @OA\Property(property="pass",type="string",description="密码"),
     *                              @OA\Property(property="tag",type="array",description="用户标签",
     *                                  @OA\Items(
     *                                      items="tagId", type="integer", description="标签id"
     *                                  ),
     *                              ),
     *                              @OA\Property(property="departments",type="array",description="部门信息",
     *                                  @OA\Items(
     *                                      @OA\Property(property="id", type="integer", description="部门id"),
     *                                      @OA\Property(property="name", type="string",description="部门名称"),
     *                                  ),
     *                              ),
     *                              @OA\Property(property="default_head_img",type="file",description="默认头像"),
     *                              @OA\Property(property="videos",type="array",description="我的视频",
     *                                  @OA\Items(
     *                                      items="vide", type="file", description="视频"
     *                                  ),
     *                              ),
     *                          )
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
     *     path="/swagger-user/post-json",
     *     tags={"swagger用户"},
     *     summary="创建用户",
     *     description="创建用户",
     *     operationId="postDemoUser",
     *     deprecated=false,
     *     security={{"oauth2": {"scope"}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               required={"user_name", "pass"},
     *               @OA\Property(property="user_name",type="string",description="用户名"),
     *               @OA\Property(property="pass",type="string",description="密码"),
     *               @OA\Property(property="departments",type="array",description="部门信息",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="integer", description="部门id"),
     *                      @OA\Property(property="name", type="string",description="部门名称"),
     *                  ),
     *               ),
     *              @OA\Property(property="tag",type="array",description="用户标签",
     *                  @OA\Items(
     *                      items="tagId", type="integer", description="标签id"
     *                  ),
     *               ),
     *              @OA\Property(property="default_head_img",type="file",description="默认头像"),
     *              @OA\Property(property="videos",type="array",description="我的视频",
     *                  @OA\Items(
     *                      items="vide", type="file", description="视频"
     *                  ),
     *              ),
     *            )
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
     *                          @OA\Property(property="data", type="object",
     *                              @OA\Property(property="uid",type="integer",description="用户uid"),
     *                          ),
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
     *     path="/swagger-user/post-form-data",
     *     tags={"swagger用户"},
     *     summary="创建用户",
     *     description="创建用户",
     *     operationId="postDemoUser",
     *     deprecated=false,
     *     security={{"oauth2": {"scope"}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"user_name", "pass"},
     *               @OA\Property(property="user_name",type="string",description="用户名"),
     *               @OA\Property(property="pass",type="string",description="密码"),
     *               @OA\Property(property="departments",type="array",description="部门信息",
     *                  @OA\Items(
     *                      @OA\Property(property="id", type="integer", description="部门id"),
     *                      @OA\Property(property="name", type="string",description="部门名称"),
     *                  ),
     *               ),
     *              @OA\Property(property="tag",type="array",description="用户标签",
     *                  @OA\Items(
     *                      items="tagId", type="integer", description="标签id"
     *                  ),
     *               ),
     *              @OA\Property(property="default_head_img",type="file",description="默认头像"),
     *              @OA\Property(property="videos",type="array",description="我的视频",
     *                  @OA\Items(
     *                      items="vide", type="file", description="视频"
     *                  ),
     *              ),
     *            )
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
     *                          @OA\Property(property="data", type="object",
     *                              @OA\Property(property="uid",type="integer",description="用户uid"),
     *                          ),
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
     *      path="/swagger-user/{uid}",
     *      operationId="getDemoUser",
     *      tags={"swagger用户"},
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
     *                  @OA\Property(property="status",type="string",description="状态: [T->成功, F->失败]"),
     *                  @OA\Property(property="message",type="string",description="接口消息"),
     *                  @OA\Property(property="code",type="string",description="错误码"),
     *                  @OA\Property(property="data",type="object",description="数据"),
     *              ),
     *          ),
     *      ),
     * )
     */
    public function delete()
    {

    }
}