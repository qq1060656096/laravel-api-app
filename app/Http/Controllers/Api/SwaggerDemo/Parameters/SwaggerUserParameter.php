<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 07:33
 */

namespace App\Http\Controllers\Api\SwaggerDemo\Parameters;

/**
 * Class SwaggerUserParameter
 * @package App\Http\Controllers\Api\SwaggerDemo\Parameters
 *
 * @OA\Parameter(
 *      name="uid",
 *      description="用户uid",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="integer"
 *      )
 *  )
 *
 */
class SwaggerUserParameter
{

}