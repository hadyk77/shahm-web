<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;

class LanguageApiMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->filled("lang") && in_array($request->lang, ['ar', "en"])) {
            App::setLocale($request->lang);
        }
        return $next($request);
    }
}
