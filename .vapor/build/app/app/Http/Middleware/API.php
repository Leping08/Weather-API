<?php

namespace App\Http\Middleware;

use Closure;

class API
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
        if($request->api_key != config('api.key')) {
            return response()->json('Invalid API Key', 401);
        }
        return $next($request);
    }
}
