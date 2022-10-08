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
            "first_phone" => "0123456789",
            "facebook_link" => 'https://facebook.com',
            "twitter_link" => 'https://twitter.com',
            "instagram_link" => 'https://instagram.com',
            "linkedin_link" => 'https://linkedin.com',
            "snapchat_link" => 'https://snapchat.com',
            "tiktok_link" => 'https://tiktok.com',

            "fcm_key" => "AAAAs8QGDaA:APA91bELNJCcJibR7AKfo_JizU65ptU0yUuPwpHyvhUG8D8kFm0kB1fMrhxEmk6cebnT1as1Hm253P1TEu4HgvARCjphWdwir7dVY21qNltWGhZtU7UeSphq2n4QvRNyh0wbtF4eAyjl",
            "firebase_api_key" => "AIzaSyBzYZXQKKTRIravYfe8kBfkCJAwJTp7lMs",
            "firebase_auth_domain" => "shahm-app.firebaseapp.com",
            "firebase_database_url" => "https://shahm-app-default-rtdb.firebaseio.com/",
            "firebase_project_id" => "shahm-app",
            "firebase_storage_bucket" => "shahm-app.appspot.com",
            "firebase_messaging_sender_id" => "772087877024",
            "firebase_app_id" => "1:772087877024:android:5d31e17fc2f80103aa28c5",
        ]);

        $logo = public_path("test_images/logo.png");

        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::LOGO_IMAGE);
        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE);


    }
}
