<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Allergen;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Translatable;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }

    public function boot()
    {
        Model::unguard();
    }
}
