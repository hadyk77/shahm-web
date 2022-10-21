<?php

namespace App\Providers;

use App\Channels\DatabaseChannel;
use App\Enums\GuardEnum;
use App\Models\Admin;
use App\Models\ChatMessage;
use App\Models\GeneralSetting;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;
use Spatie\Translatable\Translatable;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {

        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        if (Schema::hasTable("general_settings")) {

            if (GeneralSetting::query()->first()) {

                Config::set("larafirebase.authentication_key", GeneralSetting::query()->first()->fcm_key);

            }

        }

        $this->app->instance(IlluminateDatabaseChannel::class, new DatabaseChannel());

        Model::unguard();

        LogViewer::auth(function ($request) {
            return Auth::guard(GuardEnum::ADMIN)->check();
        });
    }
}
