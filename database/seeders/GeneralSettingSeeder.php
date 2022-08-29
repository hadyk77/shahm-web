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

            "fcm_key" => "AAAAAtjXarI:APA91bG9EPze9Yfp4cZYO1nLJ-MIQ6x6wP-grp6s5BhSQMDbXTKgIyBvGIyMeh930WteB6cZcqOsj8Y2mGMzB4-IJcTZAGhtBIHC3kqZcYpBjnp_rma8BLL5yCIId-6Tv-uXQC_A5KLX",
            "firebase_api_key" => "AIzaSyAh64uLHY0h303UgPiTEvs2j59DraFbIhQ",
            "firebase_auth_domain" => "shahm-54b6f.firebaseapp.com",
            "firebase_database_url" => "https://shahm-54b6f-default-rtdb.firebaseio.com/",
            "firebase_project_id" => "shahm-54b6f",
            "firebase_storage_bucket" => "shahm-54b6f.appspot.com",
            "firebase_messaging_sender_id" => "12227930802",
            "firebase_app_id" => "1:12227930802:web:d54a54be303bc8e96db7ab",
        ]);

        $logo = public_path("test_images/logo.png");

        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::LOGO_IMAGE);
        $setting->addMedia($logo)->preservingOriginal()->toMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE);


    }
}
