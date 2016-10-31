<?php
/**
 * Created by PhpStorm.
 * User: songhang
 * Date: 16-10-28
 * Time: 下午8:45
 */

namespace App\Exceptions;


class Exception extends \Exception
{
    protected $errCode ;
    protected $errMsg;

    public function __construct($code = 'invalid.request', $msg='非法请求！'){
        $this->errCode = $code;
        $this->errMsg = $msg;
        $this->message = "[$code:$msg]";
    }

    public function getErrCode(){
        return $this->errCode;
    }

    public function getErrMsg(){
        return $this->errMsg;
    }
}