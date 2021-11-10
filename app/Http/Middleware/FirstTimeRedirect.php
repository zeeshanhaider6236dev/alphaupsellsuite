<?php

namespace App\Http\Middleware;

use Closure;

class FirstTimeRedirect
{
    public function handle($request, Closure $next)
    {
        if(request('hmac') != null):
            return redirect()->route('home');
        endif;
        return $next($request);
    }
}
