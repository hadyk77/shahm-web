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
            "first_email" => "admin@admin.com",
            "first_phone" => "0123456789"
        ]);

        $logo = public_path("test_images/logo.png");

        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::LOGO_IMAGE);
        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE);


    }
}
