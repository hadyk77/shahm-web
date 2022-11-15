<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Illuminate\Http\Request;

class TimeZoneMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader("X-Time-Zone")) {
            if (in_array($request->header("X-Time-Zone"), [
                "Asia/Amman",
                "Asia/Dubai",
                "Asia/Riyadh",
                "Africa/Cairo",
            ])) {
                Config::set("app.timezone", $request->header("X-Time-Zone"));
            }
        }
        return $next($request);
    }
}
