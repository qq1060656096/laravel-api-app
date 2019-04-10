<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 23:26
 */

namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundException extends NotFoundHttpException implements AppErrorCodeException
{

}