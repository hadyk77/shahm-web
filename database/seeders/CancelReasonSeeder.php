<?php

namespace Database\Seeders;

use App\Models\CancelReason;
use Illuminate\Database\Seeder;

class CancelReasonSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                "title" => [
                    "ar" => "الطلب متأخر و المندوب لا يجب",
                    "en" => "الطلب متأخر و المندوب لا يجب",
                ]
            ],
            [
                "title" => [
                    "ar" => "سبب أخر غير مذكور",
                    "en" => "سبب أخر غير مذكور",
                ]
            ],
            [
                "title" => [
                    "ar" => "المتجر مغلق، أو الطلب غير متوفر",
                    "en" => "المتجر مغلق، أو الطلب غير متوفر",
                ]
            ],
            [
                "title" => [
                    "ar" => "المندوب طلب الإلغاء",
                    "en" => "المندوب طلب الإلغاء",
                ]
            ],
            [
                "title" => [
                    "ar" => "المندوب لا يقبل الدفع الإلكتروني",
                    "en" => "المندوب لا يقبل الدفع الإلكتروني",
                ]
            ],
            [
                "title" => [
                    "ar" => "لم أعد أحتاج الطلب",
                    "en" => "لم أعد أحتاج الطلب",
                ]
            ]
        ];

        foreach ($items as $item){
            CancelReason::query()->create($item);
        }
    }
}
