<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Never run in the console.
        if (app()->runningInConsole()) {
            return $next($request);
        }

        // Only enforce HTTPS in production.
        if (! app()->isProduction()) {
            return $next($request);
        }

        // The setting only supports "0" and "1".
        $enabled = (string) setting('FORCE_HTTPS', '0') === '1';

        // Redirect HTTP requests to HTTPS.
        if ($enabled && ! $request->secure()) {
            return redirect()->secure(
                $request->getRequestUri(),
                Response::HTTP_FOUND // 302 Temporary Redirect
            );
        }

        return $next($request);
    }
}