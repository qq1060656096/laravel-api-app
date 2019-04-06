<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-04-05
 * Time: 23:26
 */

namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UnprocessableEntityHttp extends UnprocessableEntityHttpException
{
    protected $errors = array();

    public function setErrors(array $errors){
        $this->errors = $errors;
    }

    public function getErrors(){
        return $this->errors;
    }
}