<?php

namespace Database\Seeders;

use App\Enums\CountryEnum;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                "title" => [
                    "ar" => "مصر",
                    "en" => "Egypt"
                ],
                'country_code' => "+20",
                "flag" => public_path("admin/media/flags/egypt.svg")
            ],
            [
                "title" => [
                    "ar" => "المملكة العربية السعودية",
                    "en" => "Kingdom Saudi Arabia"
                ],
                'country_code' => "+966",
                "flag" => public_path("admin/media/flags/saudi-arabia.svg")
            ],
            [
                "title" => [
                    "ar" => "الامارات العربية المتحدة",
                    "en" => "The United Arab Emirates"
                ],
                'country_code' => "+971",
                "flag" => public_path("admin/media/flags/united-arab-emirates.svg")
            ],
        ];

        foreach ($items as $item) {
            $country = Country::query()->create([
                "title" => $item['title'],
                "country_code" => $item['country_code'],
            ]);
            $country->addMedia($item["flag"])->preservingOriginal()->toMediaCollection(CountryEnum::FLAG);
        }

    }
}
