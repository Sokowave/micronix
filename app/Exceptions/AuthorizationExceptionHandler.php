<?php

namespace App\Exceptions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthorizationExceptionHandler
{
    /**
     * Handle an authorization exception.
     */
    public function handle(
        AccessDeniedHttpException $exception,
        Request $request
    ): RedirectResponse {
        return redirect()
            ->back()
            ->with(
                'error',
                'You do not have permission to perform this action.'
            );
    }
}