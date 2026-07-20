<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserResetPasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    public function showLinkRequestForm()
    {
        return view(
            'backend.auth.passwords.forgot-password'
        );
    }

    public function sendResetLink(
        Request $request
    )
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
        ]);

        $user = User::query()
            ->where(
                'email',
                $validated['email']
            )
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Backoffice Access Only
        |--------------------------------------------------------------------------
        */
        if (! $user->isBackoffice()) {
            throw ValidationException::withMessages([
                'email' => 'Unauthorized.',
            ]);
        }

        $token = Password::createToken(
            $user
        );

        Mail::to($user->email)
            ->send(
                new UserResetPasswordMail(
                    $user,
                    $token
                )
            );

        return back()->with(
            'success',
            'Reset link sent.'
        );
    }

    public function showResetForm(
        Request $request,
        $token = null
    )
    {
        return view(
            'backend.auth.passwords.reset-password',
            [
                'token' => $token,
                'email' => $request->email,
            ]
        );
    }

    public function resetPassword(
        Request $request
    )
    {
        $validated = $request->validate([
            'token' => [
                'required',
            ],

            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $status = Password::reset(
            [
                'email' => $validated['email'],
                'password' => $validated['password'],
                'password_confirmation' => $request->password_confirmation,
                'token' => $validated['token'],
            ],
            function ($user) use ($validated) {

                /*
                |--------------------------------------------------------------------------
                | Backoffice Access Only
                |--------------------------------------------------------------------------
                */
                if (! $user->isBackoffice()) {
                    throw ValidationException::withMessages([
                        'email' => 'Unauthorized.',
                    ]);
                }

                $user->forceFill([
                    'password' => Hash::make(
                        $validated['password']
                    ),
                ]);

                $user->setRememberToken(
                    Str::random(60)
                );

                $user->save();

                event(
                    new PasswordReset($user)
                );
            }
        );

        if (
            $status === Password::PASSWORD_RESET
        ) {
            return redirect()
                ->route('backoffice.login')
                ->with(
                    'success',
                    'Password reset successful.'
                );
        }

        throw ValidationException::withMessages([
            'email' => [
                __($status),
            ],
        ]);
    }
}