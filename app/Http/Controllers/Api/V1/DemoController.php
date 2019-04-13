<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\NotFoundException;
use App\Exceptions\OAuthException;
use App\Exceptions\UnprocessableEntityHttp;
use App\Http\ApiResponse;
use App\Models\UserDemoModel;
use App\OAuth2\Helper\AuthHelper;
use App\OAuth2\Users\LoginUser;
use App\Transformer\UserDemoTransformer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $identifier = \auth()->id();
        $user       = auth()->user();
        $userClass  = get_class($user);
        $accountId  = $user->getLoginUser()->getAccountId();
        $data = [
            '$identifier' => $identifier,// login_user_zhaowei7900818574d95a2996bf63784e579d586f99b549
            '$user' => $user, // App\OAuth2\Users\CustomAuthUser 实例
            '$userClass' => $userClass, // App\OAuth2\Users\CustomAuthUser
            '$accountId' => $accountId, // accountId
        ];
        var_dump($data);
        /*
array(4) {
  ["$identifier"]=>
  string(58) "login_user_zhaowei7900818574d95a2996bf63784e579d586f99b549"
    ["$user"]=>
  object(App\OAuth2\Users\CustomAuthUser)#585 (6) {
  ["identityName":protected]=>
    string(2) "id"
    ["password":protected]=>
    string(0) ""
    ["rememberToken":protected]=>
    string(0) ""
    ["rememberTokenName":protected]=>
    string(0) ""
    ["loginUser":protected]=>
    object(App\OAuth2\Users\LoginUser)#584 (5) {
    ["data":"App\OAuth2\Users\LoginUser":private]=>
      array(0) {
    }
      ["grantType":protected]=>
      string(7) "wx_code"
    ["accountId":protected]=>
      string(7) "zhaowei"
    ["accountType":protected]=>
      string(7) "default"
    ["params":protected]=>
      array(0) {
    }
    }
["id"]=>
string(58) "login_user_zhaowei7900818574d95a2996bf63784e579d586f99b549"
}
["$userClass"]=>
  string(31) "App\OAuth2\Users\CustomAuthUser"
["$accountId"]=>
  string(7) "zhaowei"
}
*/
        exit;
    }
}
