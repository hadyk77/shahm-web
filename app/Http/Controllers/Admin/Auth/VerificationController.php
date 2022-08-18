<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Enums\GuardEnum;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Laravel\Sanctum\Guard;

class VerificationController extends Controller
{

    use VerifiesEmails;

    protected string $redirectTo = "/admin/dashboard";

    public function __construct()
    {
        $this->middleware('auth:' . GuardEnum::ADMIN);
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('admin.auth.verify');
    }
}
