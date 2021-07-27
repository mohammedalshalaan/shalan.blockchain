<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
        $pleaseExists = $request->exists('please');

        if($pleaseExists){
            $request['please'] = "thankyou";

            return $next($request);
        } else{
            return response("");
        }
        */
    }
}
