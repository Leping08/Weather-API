<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Domain
{
    protected $hosts = [
        'derkweather.com'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (App::environment('production')) {
            $hosts = collect($this->hosts);
            if ($hosts->contains($request->getHost())) {
                return $next($request);
            } else {
                return response('Request is not from the correct domain.', 403);
            }
        } else {
            return $next($request);
        }
    }
}
