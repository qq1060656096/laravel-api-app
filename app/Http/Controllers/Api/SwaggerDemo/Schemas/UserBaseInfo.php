<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-12
 * Time: 14:28
 */

namespace App\Http\Controllers\Api\SwaggerDemo\Schemas;



/**
 * 用户基本信息
 *
 * Class UserBaseInfo
 * @package App\Http\Controllers\Api\SwaggerDemo\Schemas
 *
 * @OA\Schema(
 *     schema="user_base_info_schema",
 *     description="用户基本信息",
 *     type="object",
 * )
 *
 */
class UserBaseInfo
{
    /**
     * @var
     * @OA\Property(property="mobile",type="number",description="手机号"),
     */
    protected $mobile;

    /**
     * @var
     * @OA\Property(property="nick_name",type="string",description="昵称"),
     */
    protected $nick_name;

    /**
     * @var
     * @OA\Property(property="avatar_url",type="string",description="头像地址"),
     */
    protected $avatar_url;

    /**
     * @var
     * @OA\Property(property="wechat_num",type="string",description="微信号"),
     */
    protected $wechat_num;

    /**
     * @var
     * @OA\Property(property="duty",type="string",description="担任职务"),
     */
    protected $duty;

    /**
     * @var
     * @OA\Property(property="email",type="string",description="邮箱"),
     */
    protected $email;

    /**
     * @var
     * @OA\Property(property="address",type="string",description="地址"),
     */
    protected $address;

    /**
     * @var
     * @OA\Property(property="user_id",type="number",description="用户"),
     */
    protected $user_id;
}