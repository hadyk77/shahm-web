<?php

namespace Database\Seeders;

use App\Enums\CaptainEnum;
use App\Enums\ProfileImageEnum;
use App\Models\CaptainVerificationFile;
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
        $user->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);

        $user1 = User::query()->create([
            "name" => "الكابتن الأول",
            "phone" => "+201201192461",
            "captain_phone_number" => "+201201192461",
            "is_captain_phone_number_verified" => 1,
            "captain_status" => 1,
            "is_captain" => 1,
            "status" => 1,
            "email" => "captain@captain.com",
            "date_of_birth" => "1998-12-01",
            "gender" => "male",
            "address" => "Samannoud, Samannoud City, Samanoud",
            "address_lat" => 30.9614,
            "address_long" => 31.2413,
            "app_version" => "1.0.0",
        ]);
        $captain = $user1->captain()->create([
            "vehicle_type_id" => 1,
            "nationality_id" => 1,
            "identification_number" => 123456789,
            "vehicle_manufacturing_date" => "2022-01-01",
            "account_upgrade_option_id" => 1,
            "wallet_number" => 0,
            "vehicle_identification_number" => 123456789,
            "vehicle_license_plate_number" => 123456789,
        ]);
        $captain->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_FRONT);
        $captain->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_BACK);
        $captain->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(CaptainEnum::CAR_PICTURE_FROM_FRONT);
        $captain->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(CaptainEnum::CAR_PICTURE_FROM_BACK);
        $captain->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(CaptainEnum::IDENTIFICATION_FROM_BACK);
        $captain->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(CaptainEnum::IDENTIFICATION_FROM_FRONT);
        $verificationFile = CaptainVerificationFile::query()->create([
            "captain_id" => $captain->id,
            "verification_option_id" => 1,
            "user_id" => $captain->user->id,
        ]);
        $verificationFile->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(CaptainEnum::VERIFICATION_FILE);
        $verificationFile = CaptainVerificationFile::query()->create([
            "captain_id" => $captain->id,
            "verification_option_id" => 2,
            "user_id" => $captain->user->id,
        ]);
        $verificationFile->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(CaptainEnum::VERIFICATION_FILE);
        $user1->addMedia(public_path("test_images/logo.png"))->preservingOriginal()->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
    }
}
