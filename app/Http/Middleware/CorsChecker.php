<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class CorsChecker
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
        header("Access-Control-Allow-Origin: {parse_url($request->headers->get('origin'), PHP_URL_HOST)}");
        // header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        // ALLOW OPTIONS METHOD
        return $next($request);
    }
}
