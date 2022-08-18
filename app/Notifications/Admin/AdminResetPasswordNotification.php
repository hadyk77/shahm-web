<?php

namespace App\Notifications\Admin;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;

class AdminResetPasswordNotification extends ResetPassword
{
    protected function resetUrl($notifiable): string|UrlGenerator|Application
    {
        return url(route('admin.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}
