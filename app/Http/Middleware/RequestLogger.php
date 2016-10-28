<?php
/**
 * Created by PhpStorm.
 * User: hwang
 * Date: 2016/2/19
 * Time: 17:21
 */

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Log;
use Closure;

class RequestLogger
{
    /**
     * @param Request $request
     * @param Closure $next
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info("REQUEST<<<<[{$request->path()}]", $request->all());

        $response = $next($request);

        $status = $response->status();
        $contentType = $response->headers->get('Content-Type');
        $content = $response->content();

        if($contentType != 'application/json'){
            $content = 'html';
        }
        Log::info('RESPONSE>>>', ['status'=>$status, 'content'=>$content]);

        return $response;
    }

}