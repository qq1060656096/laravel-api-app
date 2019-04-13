<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 微信小程序
 *
 * Class WxAppletController
 * @package App\Http\Controllers\Api\V1
 */
class WxAppletController extends Controller
{
    /**
     * @param ApiResponse $response
     *
     * @OA\Post(
     *     path="/api/v1/wx-applet/decode-phone-number",
     *     tags={"微信小程序"},
     *     summary="",
     *     description="解码手机号码",
     *     operationId="解码手机号码",
     *     deprecated=false,
     *     security={{"oauth2": {"scope"}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               required={"encryptedData", "iv"},
     *               @OA\Property(property="encryptedData",type="string",description="包括敏感数据在内的完整用户信息的加密数据"),
     *               @OA\Property(property="iv",type="string",description="加密算法的初始向量"),
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
     *                              @OA\Property(property="phoneNumber",type="string",description="用户绑定的手机号（国外手机号会有区号）"),
     *                              @OA\Property(property="purePhoneNumber",type="string",description="没有区号的手机号"),
     *                              @OA\Property(property="countryCode",type="string",description="区号"),
     *                          ),
     *                      ),
     *                  }
     *              )
     *          ),
     *      ),
     * )
     */
    public function decodePhoneNumber(ApiResponse $response)
    {

    }

    /**
     * @param ApiResponse $response
     * @OA\Post(
     *     path="/api/v1/wx-applet/wx-acode-unlimit",
     *     tags={"微信小程序"},
     *     summary="",
     *     description="获取小程序二维码",
     *     operationId="获取小程序二维码，适用于需要的码数量极多的业务场景。通过该接口生成的小程序码，永久有效，数量暂无限制。",
     *     deprecated=false,
     *     security={{"oauth2": {"scope"}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *               type="object",
     *               required={"scene"},
     *               @OA\Property(property="scene",type="string",description="最大32个可见字符，只支持数字，大小写英文以及部分特殊字符：!#$&'()*+,/:;=?@-._~，其它字符请自行编码为合法字符（因不支持%，中文无法使用 urlencode 处理，请使用其他编码方式）"),
     *               @OA\Property(property="page",type="string",description="必须是已经发布的小程序存在的页面（否则报错），例如 pages/index/index, 根路径前不要填加 /,不能携带参数（参数请放在scene字段里），如果不填写这个字段，默认跳主页面"),
     *               @OA\Property(property="width",type="string",description="二维码的宽度，单位 px，最小 280px，最大 1280px"),
     *               @OA\Property(property="auto_color",type="string",description="自动配置线条颜色，如果颜色依然是黑色，则说明不建议配置主色调，默认 false"),
     *               @OA\Property(property="line_color",type="string",description="auto_color 为 false 时生效，使用 rgb 设置颜色 例如 {r:xxx,g:xxx,b:xxx} 十进制表示"),
     *               @OA\Property(property="is_hyaline",type="string",description="是否需要透明底色，为 true 时，生成透明底色的小程序"),
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
     *                              @OA\Property(property="phoneNumber",type="string",description="用户绑定的手机号（国外手机号会有区号）"),
     *                              @OA\Property(property="purePhoneNumber",type="string",description="没有区号的手机号"),
     *                              @OA\Property(property="countryCode",type="string",description="区号"),
     *                          ),
     *                      ),
     *                  }
     *              )
     *          ),
     *      ),
     * )
     */
    public function getWxaCodeUnLimit(ApiResponse $response)
    {

    }
}
