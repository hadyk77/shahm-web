<?php

namespace App\View\Composers;

use App\Models\GeneralSetting;
use Illuminate\View\View;

class SettingComposer
{
    public function compose(View $view): void
    {
        $view->with("setting", GeneralSetting::query()->first());
    }
}
