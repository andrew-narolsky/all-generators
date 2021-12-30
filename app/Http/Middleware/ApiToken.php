<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request,
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->get('key') == env('CONCLUSION_GENERATOR_API_KEY')) {
            return $next($request);
        }
        abort(Response::HTTP_UNAUTHORIZED);
    }
}
