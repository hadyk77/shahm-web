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
                    "ar" => "العرض  الاول",
                    "en" => "First Offer"
                ],
                "order" => 1,
                "image" => public_path("test_images/banners/01.jpg"),
            ],
            [
                "title" => [
                    "ar" => "العرض  الثانى",
                    "en" => "Second Offer"
                ],
                "order" => 2,
                "image" => public_path("test_images/banners/02.jpg"),
            ],
            [
                "title" => [
                    "ar" => "العرض  الثالث",
                    "en" => "Third Offer"
                ],
                "order" => 3,
                "image" => public_path("test_images/banners/03.jpg"),
            ],
        ];

        foreach ($banners as $banner) {

            $createdBanner = Banner::query()->create([
                "title" => $banner['title'],
                'order' => $banner["order"],
            ]);

            $createdBanner->addMedia($banner["image"])->preservingOriginal()->toMediaCollection(BannerEnum::BannerImage);
        }

    }
}
