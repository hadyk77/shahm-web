<?php

namespace Database\Seeders;

use App\Enums\BannerEnum;
use App\Models\Banner;
use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    public function run()
    {

        Nationality::query()->create([
            "title" => [
                "ar" => "الجنسية السعودية",
                "en" => "Saudi nationality"
            ]
        ]);

        Nationality::query()->create([
            "title" => [
                "ar" => "الجنسية المصرية",
                "en" => "Egyptian nationality"
            ]
        ]);

    }
}
