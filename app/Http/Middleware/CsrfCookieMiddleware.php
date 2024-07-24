<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CsrfCookieMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->setCookie(
            cookie('XSRF-TOKEN', csrf_token(), 60, null, null, false, true)
        );

        return $response;
    }
}
