<?php

namespace Database\Seeders;

use App\Enums\BannerEnum;
use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run()
    {
        $banners = [
            [
                "title" => [
                    "ar" => "",
                    "en"
                ],
                "image" => public_path("test_images/banners/01.png"),
            ],
            [
                "title" => [
                    "ar" => "",
                    "en"
                ],
                "image" => public_path("test_images/banners/02.png"),
            ],
            [
                "title" => [
                    "ar" => "",
                    "en"
                ],
                "image" => public_path("test_images/banners/03.png"),
            ],
        ];

        foreach ($banners as $banner) {

            $banner = Banner::query()->create([
                "title" => $banner['title']
            ]);

            $banner->addMedia($banner["image"])->preservingOriginal(BannerEnum::BannerImage)->toMediaCollection();
        }

    }
}
