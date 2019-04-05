<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 06:22
 */

namespace App\Http\Controllers\Api\SwaggerDemo\Schemas;


/**
 * Class SwaggerUserRawSchema
 * @package App\Http\Controllers\Api\SwaggerDemo\Schemas
 *
 * @OA\Schema(
 *      schema="swagger_user_raw_schema",
 *      description="swagger用户",
 *      type="object",
 *      required={"user_name", "pass"},
 *      @OA\Property(property="user_name",type="string",description="用户名"),
 *      @OA\Property(property="pass",type="string",description="密码"),
 *      @OA\Property(property="tag",type="array",description="用户标签",
 *          @OA\Items(
 *              items="tagId", type="integer", description="标签id"
 *          ),
 *      ),
 *      @OA\Property(property="departments",type="array",description="部门信息",
 *          @OA\Items(
 *              @OA\Property(property="id", type="integer", description="部门id"),
 *              @OA\Property(property="name", type="string",description="部门名称"),
 *          ),
 *      ),
 *      @OA\Property(property="default_head_img",type="file",description="默认头像"),
 *      @OA\Property(property="videos",type="array",description="我的视频",
 *          @OA\Items(
 *              items="vide", type="file", description="视频"
 *          ),
 *      ),
 *  )
 */
class SwaggerUserRawSchema
{


}