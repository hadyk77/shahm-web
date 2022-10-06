<?php

namespace Database\Seeders;

use App\Enums\ProfileImageEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::query()->create([
            "name" => "عبدالرحمن المسيرى",
            "phone" => "+201201192460",
            "email" => "user@user.com",
            "date_of_birth" => "1998-12-01",
            "gender" => "male",
            "address" => "Samannoud, Samannoud City, Samanoud",
            "address_lat" => 30.9614,
            "address_long" => 31.2413,
            "app_version" => "1.0.0",
        ]);
        $user->addMedia(public_path("SEMICOLON-TECH.png"))->preservingOriginal()->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
    }
}
