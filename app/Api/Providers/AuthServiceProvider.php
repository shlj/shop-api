<?php
/**
 * Created by PhpStorm.
 * User: hwang
 * Date: 2016/1/28
 * Time: 13:01
 */

namespace App\Api\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::provider('login', function($app, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...

            return new UserProvider($app[$config['model']]);
        });
//        JWTAuth::setIdentifier('mobile');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}