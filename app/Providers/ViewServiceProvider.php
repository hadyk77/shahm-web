<?php

namespace App\Providers;

use App\View\Composers\SettingComposer;
use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer([
            "admin.layouts.app",
            "admin.layouts.auth",
            "firebase.init_firebase",
        ], SettingComposer::class);
    }
}
