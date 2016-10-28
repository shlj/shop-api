<?php

namespace App\Http\Middleware;

use Closure;

class ValidateSign
{
    const TOKEN ='u9H1l4eOa6d9aXWu3yksAwkcZJtVSn36';
    const SIGN_ALGO = 'sha256';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $params = $request->input();
        if(empty($params['sign'])){
            return response('Access forbidden empty signature.', 400);
        }
        if(empty($params['ctime'])){
            return response('Access forbidden empty request time.', 400);
        }
        if(empty($params['nonce'])){
            return response('Access forbidden empty request nonce.', 400);
        }
        $sign = $params['sign'];
        unset($params['sign']);

        $values = array_values($params);
        $values[] = self::TOKEN;

        sort($values, SORT_STRING);
        $tmpStr = implode($values);
        $tmpSign = hash( self::SIGN_ALGO, $tmpStr );

        if( $tmpSign != $sign ){
           return response('Bad Request invalid signature.', 400);
        }

        return $next($request);
    }
}
