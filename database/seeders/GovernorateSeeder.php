<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    public function run()
    {
        Governorate::query()->create([
            "title" => [
                "ar" => "الزرقاء"
            ]
        ]);
        Governorate::query()->create([
            "title" => [
                "ar" => "عمان"
            ]
        ]);
    }
}
