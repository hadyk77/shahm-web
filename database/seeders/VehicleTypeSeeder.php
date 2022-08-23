<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                "title" => [
                    "ar" => "Hatchback",
                    "en" => "Hatchback"
                ],
            ],
            [
                "title" => [
                    "ar" => "Sedan",
                    "en" => "Sedan"
                ],
            ],
            [
                "title" => [
                    "ar" => "MPV",
                    "en" => "MPV"
                ],
            ],
            [
                "title" => [
                    "ar" => "Crossover",
                    "en" => "Crossover"
                ],
            ],
            [
                "title" => [
                    "ar" => "Coupe",
                    "en" => "Coupe"
                ],
            ],
            [
                "title" => [
                    "ar" => "Convertible",
                    "en" => "Convertible"
                ],
            ],
        ];

        foreach ($items as $item) {
            VehicleType::query()->create($item);
        }
    }
}
