<?php

namespace App\Http\Middleware;

use App\Support\UserRoles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BackofficeMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            ! $request->user() ||
            ! in_array($request->user()->role, UserRoles::BACKOFFICE, true)
        ) {
            abort(403);
        }

        return $next($request);
    }
}