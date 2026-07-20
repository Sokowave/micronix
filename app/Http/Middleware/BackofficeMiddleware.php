<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BackofficeMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (! Auth::check()) {
            return redirect()->route('backoffice.login');
        }

        $user = Auth::user();

        if (! $user->isBackoffice()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('backoffice.login')
                ->with('error', __('Unauthorized access.'));
        }

        return $next($request);
    }
}