<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use APIReturn;

class AdminCheck extends BaseMiddleware
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
        //$token = $this->auth->setRequest($request)->getToken();

        $user= $this->auth->parseToken()->authenticate();
        if($user->admin){
            return $next($request);
        }

        return \APIReturn::error("Permission denied",403);
    }
}
