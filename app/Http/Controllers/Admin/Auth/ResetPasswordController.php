<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\GuardEnum;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected string $redirectTo = "/admin/dashboard";

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('admin.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return Password::broker(GuardEnum::ADMIN . 's');
    }

    protected function guard()
    {
        return Auth::guard(GuardEnum::ADMIN);
    }
}
