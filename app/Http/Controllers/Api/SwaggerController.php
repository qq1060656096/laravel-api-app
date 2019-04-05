<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use function GuzzleHttp\Psr7\str;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="laravel-api脚手架",
 *      description="laravel-api脚手架",
 *      @OA\Contact(
 *          email="darius@matulionis.lt"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */

/**
 *
 * @OA\Response(
 *     response=200,
 *     description="successful operation",
 * )
 *
 * @OA\Response(
 *     response=400,
 *     description="successful operation",
 * )
 *
 * @OA\Response(
 *     response=401,
 *     description="successful operation",
 * )
 *
 * @OA\Response(
 *     response=404,
 *     description="successful operation",
 * )
 *
 * @OA\Response(
 *     response=405,
 *     description="successful operation",
 * )
 * @OA\Response(
 *     response=422,
 *     description="successful operation",
 * )
 *
 *
 */

/**
 *
 * @OA\Server(
 *      url="http://business-card.local",
 *      description="本地环境"
 * )
 *
 * @OA\Server(
 *      url="http://business-cardf1.newdhb.com",
 *      description="开发环境"
 * )
 *
 *  @OA\Server(
 *      url="http://business-cardf.newdhb.com",
 *      description="测试环境"
 * )
 *
 *
 *  @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="动态host"
 *  )
 *
 */

/**
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     description="Use a global client_id / client_secret and your username / password combo to obtain a token",
 *     name="Password Based",
 *     in="header",
 *     scheme="https",
 *     securityScheme="Password Based",
 *     @OA\Flow(
 *         flow="password",
 *         authorizationUrl="/oauth/authorize",
 *         tokenUrl="/oauth/token",
 *         refreshUrl="/oauth/token/refresh",
 *         scopes={}
 *     )
 * )
 */
/**
 *
 * @OA\ExternalDocumentation(
 *     description="Find out more about Swagger",
 *     url="http://swagger.io"
 * )
 */

class SwaggerController extends Controller
{

}