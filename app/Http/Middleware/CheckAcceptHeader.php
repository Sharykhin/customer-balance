<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

/**
 * Class CheckAcceptHeader
 * @package App\Http\Middleware
 */
class CheckAcceptHeader
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
        if ($request->headers->has('Accept') &&
            mb_strtolower($request->headers->get('Accept')) !== '*/*' &&
            strpos('application/json', mb_strtolower($request->headers->get('Accept'))) === false) {
            return response()->badRequest(['headers' => 'Accept must be application/json']);
        }

        return $next($request);
    }
}
