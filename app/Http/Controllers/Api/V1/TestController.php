<?php
/**
 * Created by PhpStorm.
 * User: songhang
 * Date: 16-10-28
 * Time: 下午6:25
 */

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\BaseController;

class TestController extends BaseController
{
    public function index()
    {
        return response()->succ();
    }
}