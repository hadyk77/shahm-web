<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\GuardEnum;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = "/admin/dashboard";

    public function __construct()
    {
        $this->middleware('guest:' . GuardEnum::ADMIN)->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function username()
    {
        return 'username';
    }

    protected function guard()
    {
        return Auth::guard(GuardEnum::ADMIN);
    }
}
