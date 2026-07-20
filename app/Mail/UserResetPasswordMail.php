<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserResetPasswordMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public string $token;

    public User $user;

    public function __construct(
        User $user,
        string $token
    ) {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Determine reset route.
     */
    protected function getResetRoute(): string
    {
        return $this->user->isBackoffice()
            ? 'backoffice.password.reset'
            : 'customer.password.reset';
    }

    public function build()
    {
        $resetLink = route(
            $this->getResetRoute(),
            [
                'token' => $this->token,
                'email' => $this->user->email,
            ]
        );

        return $this->subject(
                'Reset Your Account Password'
            )
            ->view(
                'emails.user.reset-password'
            )
            ->with([
                'resetLink' => $resetLink,
                'user' => $this->user,
            ]);
    }
}