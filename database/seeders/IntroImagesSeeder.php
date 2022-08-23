<?php

namespace Database\Seeders;

use App\Enums\IntroImagesEnum;
use App\Models\IntroImages;
use Illuminate\Database\Seeder;

class IntroImagesSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                "title" => [
                    'ar' => "قم بطلب أي شيء تريده",
                    'en' => "Order anything you want"
                ],
                "description" => [
                    'ar' => "يوفر لك التطبيق العديد من الاختيارات والاحتياجات التي تريدها بشكل يومي قم باختيار احتياجاتك ودع الباقي علينا",
                    'en' => "The application provides you with many options And the needs that you want on a daily basis, choose your needs and leave the rest to us"
                ],
                "image" => public_path("test_images/intro-image/intro-01.jpg")
            ],
            [
                "title" => [
                    'ar' => "قم بطلب أي شيء تريده",
                    'en' => "Order anything you want"
                ],
                "description" => [
                    'ar' => "يوفر لك التطبيق العديد من الاختيارات والاحتياجات التي تريدها بشكل يومي قم باختيار احتياجاتك ودع الباقي علينا",
                    'en' => "The application provides you with many options And the needs that you want on a daily basis, choose your needs and leave the rest to us"
                ],
                "image" => public_path("test_images/intro-image/intro-02.jpg")
            ],
            [
                "title" => [
                    'ar' => "قم بطلب أي شيء تريده",
                    'en' => "Order anything you want"
                ],
                "description" => [
                    'ar' => "يوفر لك التطبيق العديد من الاختيارات والاحتياجات التي تريدها بشكل يومي قم باختيار احتياجاتك ودع الباقي علينا",
                    'en' => "The application provides you with many options And the needs that you want on a daily basis, choose your needs and leave the rest to us"
                ],
                "image" => public_path("test_images/intro-image/intro-03.jpg")
            ],
        ];

        foreach ($items as $item) {
            $introImage = IntroImages::query()->create([
                "title" => $item["title"],
                "description" => $item["description"],
            ]);
            $introImage
                ->addMedia($item["image"])
                ->preservingOriginal()
                ->toMediaCollection(IntroImagesEnum::IMAGE);
        }
    }
}
