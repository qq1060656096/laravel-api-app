<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use League\OAuth2\Server\Exception\OAuthException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        switch (true) {
            // 401
            case $exception instanceof OAuthServerException:
            case $exception instanceof OAuth2Exception:
                return $this->unauthenticatedNew($request, $exception);
                break;
            // 404
            case $exception instanceof NotFoundException:
                return $this->notFound($request, $exception);
                break;
            // 422
            case $exception instanceof UnprocessableEntityHttp:
                return $this->unprocessableEntity($request, $exception);
                break;
            // 429
            case $exception instanceof TooManyRequestsHttpException:
                return $this->tooManyRequests($request, $exception);
                break;
            case $exception instanceof HttpException:
                return $this->httpException($request, $exception);
                break;

        }
        return parent::render($request, $exception);
    }


    /**
     * 401 Unauthorized 未授权
     * @param \Illuminate\Http\Request $request
     * @param  $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function unauthenticatedNew($request, $exception)
    {
        $message = $exception->getMessage() ? $exception->getMessage() : 'Unauthorized';
        return $this->getExceptionResponseJson(401, 'F', 401, $message, $exception);
    }

    /**
     * 404 not found 异常
     * @param $request
     * @param NotFoundException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound($request, NotFoundException $exception)
    {
        $message = $exception->getMessage() ? $exception->getMessage() : 'not found';
        return $this->getExceptionResponseJson(404, 'F', 404, $message, $exception);
    }


    /**
     * 404 not found 异常
     * @param $request
     * @param UnprocessableEntityHttp $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function unprocessableEntity($request, UnprocessableEntityHttp $exception)
    {
        $data['errors'] = $exception->getErrors();
        $message = $exception->getMessage() ? $exception->getMessage() : 'Unprocessable Entity';
        return $this->getExceptionResponseJson(422, 'F', 422, $message, $exception, $data);
    }

    /**
     * 429 太多的请求次数
     * @param $request
     * @param TooManyRequestsHttpException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function tooManyRequests($request, TooManyRequestsHttpException $exception)
    {
        $message = $exception->getMessage() ? $exception->getMessage() : 'Too Many Requests';
        return $this->getExceptionResponseJson(429, 'F', 429, $message, $exception);
    }

    /**
     * http异常
     * @param $request
     * @param HttpException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function httpException($request, HttpException $exception)
    {
        $message = $exception->getMessage() ? $exception->getMessage() : 'httpException';
        return $this->getExceptionResponseJson($exception->getStatusCode(), 'F', $exception->getCode(), $message, $exception);
    }

    /**
     * mo
     * @param $request
     * @param HttpException $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function defaultException($request, HttpException $exception)
    {
        $message = $exception->getMessage() ? $exception->getMessage() : 'httpException';
        return $this->getExceptionResponseJson($exception->getStatusCode(), 'F', $exception->getCode(), $message, $exception);
    }
    /**
     * 获取异常响应Json
     * @param integer $httpStatus
     * @param string $status
     * @param string $code
     * @param string $message
     * @param \Exception $exception
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExceptionResponseJson($httpStatus, $status, $code, $message, $exception, $data = [])
    {
        $jsonData = [
            'status'    => $status,
            'code'      => $code,
            'message'   => $message,
            'data'      => $data,
        ];
        $jsonData['exception'] = $this->getExceptionData($exception);

        return response()->json($jsonData, $httpStatus);
    }

    /**
     * 获取异常data
     *
     * @param Exception $exception
     * @return array
     */
    public function getExceptionData(\Exception $exception)
    {
        return [
            'class'     => get_class($exception),
            'code'      => $exception->getCode(),
            'message'   => $exception->getMessage(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine(),
            'trace'     => $exception->getTraceAsString(),
        ];
    }
}
