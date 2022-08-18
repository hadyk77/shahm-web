<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\GuardEnum;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Laravel\Sanctum\Guard;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function broker()
    {
        return Password::broker(GuardEnum::ADMIN . 's');
    }
}
