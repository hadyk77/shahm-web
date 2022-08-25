<?php

namespace App\View\Composers;

use App\Models\GeneralSetting;
use Cache;
use Illuminate\View\View;

class SettingComposer
{
    public function compose(View $view): void
    {
        $gs = Cache::remember("gs", 15 * 24 * 60 * 60, function () {
            return GeneralSetting::query()->with("media")->first();
        });
        $view->with("setting", $gs);
    }
}
