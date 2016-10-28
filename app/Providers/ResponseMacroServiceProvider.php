<?php
/**
 * Created by PhpStorm.
 * User: hwang
 * Date: 2016/1/15
 * Time: 17:24
 */

namespace App\Providers;

use App\Exceptions\HMException;
//use Response;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Http\ResponseFactory;

class ResponseMacroServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        ResponseFactory::macro('errors', function()
        {
            $args = func_get_args();
            $status = '1';

            if($args[0] instanceof HMException){
                $code = $args[0]->getErrCode();
                $msg = $args[0]->getErrMsg();
            }else{
                $code = $args[0];
                $msg = $args[1];
                if(isset($args[2]) && $args[2] != 0){
                    $status = $args[2];
                }
            }
            $data['status'] = $status;
            $data['ecode'] = $code;
            $data['msg'] = $msg;
            return response()->json($data, 200, [] , JSON_UNESCAPED_UNICODE);
        });

        ResponseFactory::macro('succ', function($data = array(), $message = 'ok')
        {
//            $args = func_get_args();
            $respData['status'] = '0';
            $respData['msg'] = $message;
            $respData['content'] = $data;

            return response()->json($respData, 200, [] , JSON_UNESCAPED_UNICODE);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}