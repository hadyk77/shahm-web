<?php

namespace Database\Seeders;

use App\Enums\GeneralSettingEnum;
use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    public function run()
    {
        $setting = GeneralSetting::query()->create([
            "title" => [
                "ar" => "شهم",
                "en" => "Sham",
            ],
            "description" => [
                "ar" => "شهم",
                "en" => "Sham",
            ],
        ]);

        $logo = public_path("test_images/SEMICOLON-TECH.png");

        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::LOGO_IMAGE);
        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE);


    }
}
