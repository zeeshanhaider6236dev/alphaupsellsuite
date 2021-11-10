<?php

namespace App\Http\Middleware;

use App\Models\UpsellType;
use Closure;

class SkipUpsell
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
        $upsellType = UpsellType::where('id', $request->segment(3))->first();
        // dd($upsellType);
        if($upsellType->name == "Sale Notification"):
            abort(404);
        endif;
        return $next($request);
    }
}
