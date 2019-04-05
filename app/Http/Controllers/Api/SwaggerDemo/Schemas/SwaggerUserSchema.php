<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 06:22
 */

namespace App\Http\Controllers\Api\SwaggerDemo\Schemas;


/**
 * Class SwaggerUser
 * @package App\Http\Controllers\Api\SwaggerDemo\Schemas
 *
 * @OA\Schema(
 *     schema="swagger_user_schema",
 *     description="swagger用户",
 *     type="object",
 * )
 */
class SwaggerUserSchema
{
    /**
     *
     * @var
     * @OA\Property(property="user_name",type="string",description="用户名"),
     */
    public $userName;

    /**
     *
     * @var
     * @OA\Property(property="pass",type="string",description="密码"),
     */
    public $pass;

    /**
     *
     * @var array
     * @OA\Property(property="tag_ids",type="array",description="标签",
     *      @OA\Items(
     *          items="tagId", type="integer", description="标签id"
     *      ),
     * ),
     */
    public $tagIds = [];


    /**
     *
     * @var object
     * @OA\Property(property="departments",type="array",description="部门",
     *      @OA\Items(
     *          @OA\Property(property="id", type="integer", description="部门id"),
     *          @OA\Property(property="name", type="string",description="部门名称"),
     *      ),
     * ),
     */
    public $departments;

    /**
     * @var
     * @OA\Property(property="head_img",type="file",description="头像"),
     */
    public $headImg;

    /**
     * @var
     * @OA\Property(property="videos",type="array",description="我的视频",
     *      @OA\Items(
     *          items="vide", type="file", description="视频"
     *      ),
     * )
     */
    public $videos;
}