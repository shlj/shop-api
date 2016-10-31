<?php
/**
 * Created by PhpStorm.
 * User: songhang
 * Date: 16-10-28
 * Time: 下午6:35
 */

namespace App\Http\Controllers\Api\V1;


use App\Exceptions\Exception;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginController extends BaseController
{
    public function login(Request $request)
    {
        $input = $request->only('username','password');

        try {
            if(empty($input['username']) || empty($input['password'])) {
                throw new Exception('user.password.invalid','用户名或密码不能为空');
            }
            $credentials['username'] = $input['username'];
            $credentials['password'] = $input['password'];

            $token = JWTAuth::attempt($credentials);

            if(!$token && isset($credentials['password']) && $credentials['password'] ){
                return response()->errors('user.password.notMatch', '用户名或密码不正确');
            }

            return response()->succ(['token'=>$token]);
        } catch (Exception $e) {
            return response()->errors($e);
        }
    }
}