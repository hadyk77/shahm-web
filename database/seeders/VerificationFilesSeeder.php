<?php

namespace Database\Seeders;

use App\Enums\VerificationOptionEnum;
use App\Models\VerificationOption;
use Illuminate\Database\Seeder;

class VerificationFilesSeeder extends Seeder
{

    public function run()
    {
        $verification1 = VerificationOption::query()->create([
            "title" => [
                'ar' => "شهادة تطعيم كورونا"
            ],
            "description" => [
                "ar" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع."
            ],
            "is_deletable" => 0,
            "related_orders" => "all"
        ]);
        $verification1->addMedia(public_path("test_images/verifications/image-01.png"))->preservingOriginal()->toMediaCollection(VerificationOptionEnum::ICON);

        $verification2 = VerificationOption::query()->create([
            "title" => [
                'ar' => "شهادة محكومية سارية"
            ],
            "description" => [
                "ar" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع."
            ],
            "is_deletable" => 0,
            "related_orders" => "all"
        ]);
        $verification2->addMedia(public_path("test_images/verifications/image-02.png"))->preservingOriginal()->toMediaCollection(VerificationOptionEnum::ICON);

        $verification3 = VerificationOption::query()->create([
            "title" => [
                'ar' => "شنطة طعام"
            ],
            "description" => [
                "ar" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع."
            ],
            "is_deletable" => 1,
            "related_orders" => "food"
        ]);
        $verification3->addMedia(public_path("test_images/verifications/image-03.png"))->preservingOriginal()->toMediaCollection(VerificationOptionEnum::ICON);

        $verification4 = VerificationOption::query()->create([
            "title" => [
                'ar' => "عبوة بنزين"
            ],
            "description" => [
                "ar" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع."
            ],
            "is_deletable" => 1,
            "related_orders" => "products"
        ]);
        $verification4->addMedia(public_path("test_images/verifications/image-04.png"))->preservingOriginal()->toMediaCollection(VerificationOptionEnum::ICON);


    }

}
