<?php

namespace App\Http\Middleware;

use App\Traits\HandleApiResponseTrait;
use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckPhoneVerificationMiddleware
{
    use HandleApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        if (is_null(Auth::user()->phone_verified_at)) {

            Auth::user()->tokens()->delete();

            return $this::sendFailedResponse(__("Your Phone number is not verified"));

        }
        return $next($request);
    }
}
