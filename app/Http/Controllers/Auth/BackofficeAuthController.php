<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BackofficeAuthController extends Controller
{
    public function showLoginForm()
    {
        return view(
            'backend.auth.login'
        );
    }

    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Input
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Rate Limiting
        |--------------------------------------------------------------------------
        */
        $key = Str::lower(
            $validated['email']
        ) . '|' . $request->ip();

        if (
            RateLimiter::tooManyAttempts(
                $key,
                5
            )
        ) {
            throw ValidationException::withMessages([
                'email' => 'Too many login attempts. Please try again later.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Find User
        |--------------------------------------------------------------------------
        */
        $user = User::query()
            ->where(
                'email',
                $validated['email']
            )
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Invalid Credentials
        |--------------------------------------------------------------------------
        */
        if (
            ! $user ||
            ! Hash::check(
                $validated['password'],
                $user->password
            )
        ) {
            RateLimiter::hit(
                $key,
                300
            );

            throw ValidationException::withMessages([
                'email' => 'Invalid credentials.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Account Status
        |--------------------------------------------------------------------------
        */
        if ($user->status !== 'active') {

            RateLimiter::hit(
                $key,
                300
            );

            throw ValidationException::withMessages([
                'email' => 'Your account is not active.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Backoffice Access
        |--------------------------------------------------------------------------
        */
        if (! $user->isBackoffice()) {

            RateLimiter::hit(
                $key,
                300
            );

            throw ValidationException::withMessages([
                'email' => 'Unauthorized access.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Login
        |--------------------------------------------------------------------------
        */
        Auth::login(
            $user,
            $request->boolean('remember')
        );

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | Clear Rate Limit
        |--------------------------------------------------------------------------
        */
        RateLimiter::clear($key);

        return redirect()
            ->intended(
                route('backoffice.dashboard')
            )
            ->with(
                'success',
                'Welcome back!'
            );
    }

    public function logout(
        Request $request
    ) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('backoffice.login')
            ->with(
                'success',
                'You have been logged out.'
            );
    }
}