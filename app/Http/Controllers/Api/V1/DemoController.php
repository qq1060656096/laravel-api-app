<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\NotFoundException;
use App\Exceptions\OAuthException;
use App\Exceptions\UnprocessableEntityHttp;
use App\Http\ApiResponse;
use App\Models\UserDemoModel;
use App\OAuth2\Server\Helper\AuthorizerHelper;
use App\Transformer\UserDemoTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class DemoController extends Controller
{
    //

    public function index(ApiResponse $response)
    {
        $httpStatusCode = \request()->get('httpStatusCode');
        switch (true) {
            case $httpStatusCode == 401:
                throw new OAuthException("401: 未授权");
                break;
            case $httpStatusCode == 404:
                throw new NotFoundException("404: 记录没找到");
                break;
            case $httpStatusCode == 422:
                $e = new UnprocessableEntityHttp("422: 无法解包");
                $e->setErrors(['id' => 'id required']);
                throw $e;
                break;
            case $httpStatusCode == 429:
                throw new TooManyRequestsHttpException(null, "太多的请求");
                break;
            case $httpStatusCode == 500:
                throw new HttpException(500, "500: 服务器内部错误");
                break;
        }
        $userDemo = new UserDemoModel();
        $userDemo->name = "demo";
        $userDemo->email = "demo@qq.com";

        return $response->withItemV1($userDemo, new UserDemoTransformer());
    }

    public function index2()
    {
//        echo 123;exit;
        $token = Authorizer::getResourceOwnerId();
        var_dump($token);exit;
        list($accountId, $accountType, $grantType, $params) = AuthorizerHelper::getDecodeResourceOwnerIdArray();
//        var_dump($accountId, $accountType, $grantType, $params);
        exit;

    }
}
