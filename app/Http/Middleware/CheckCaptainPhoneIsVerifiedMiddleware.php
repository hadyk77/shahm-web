<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckCaptainPhoneIsVerifiedMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {

            if (!Auth::user()->is_captain_phone_number_verified) {
                return Controller::sendFailedResponse(__("Your Captain Phone is not verified"));
            }

            if (!Auth::user()->is_captain) {
                return Controller::sendFailedResponse(__("You Does not have permission to access these resources"));
            }

        }

        return $next($request);
    }
}
