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
                "ar" => "قائمة الطعام",
                "en" => "MenuPages",
            ],
            "description" => [
                "ar" => "قائمة الطعام",
                "en" => "MenuPages",
            ],
            "meta_tag_title" => [
                "ar" => "قائمة الطعام",
                "en" => "MenuPages",
            ],
            "meta_tag_description" => [
                "ar" => "قائمة الطعام",
                "en" => "MenuPages",
            ],
            "meta_tag_keywords" => [
                "ar" => "قائمة الطعام",
                "en" => "MenuPages",
            ],
        ]);

        $logo = public_path("web/images/logo.jpg");

        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::LOGO_IMAGE);
        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE);


    }
}
