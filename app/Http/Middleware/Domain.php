<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class Domain
{
    protected $hosts = [
        'derkweather.com',
        'localhost'
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
            if ($hosts->contains(parse_url($request->headers->get('origin'),  PHP_URL_HOST))) {
                return $next($request);
            } else {
                Log::info("Request blocked from the host: " . parse_url($request->headers->get('origin'),  PHP_URL_HOST));
                return response('Request is not from the correct domain.', 403);
            }
        } else {
            return $next($request);
        }
    }
}
