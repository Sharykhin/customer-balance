<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

/**
 * Class CheckContentTypeHeader
 * @package App\Http\Middleware
 */
class CheckContentTypeHeader
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
        if ($request->headers->has('Content-Type') &&
            strpos('application/json', mb_strtolower($request->headers->get('Content-Type'))) === false) {
            return response()->badRequest(
                ['headers' => 'Content-Type must be application/json'],
                null,
                JsonResponse::HTTP_UNSUPPORTED_MEDIA_TYPE
            );
        }

        return $next($request);
    }
}
