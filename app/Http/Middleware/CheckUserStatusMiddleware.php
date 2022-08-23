<?php

namespace App\Http\Middleware;

use App\Traits\HandleApiResponseTrait;
use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckUserStatusMiddleware
{
    use HandleApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->status == 0) {

            Auth::user()->tokens()->delete();

            return $this::sendFailedResponse(__("Your Account is suspended, please contact support"));

        }
        return $next($request);
    }
}
