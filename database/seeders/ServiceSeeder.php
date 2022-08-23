<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                "title" => [
                    "ar" => "خدمة أرسلها عني",
                    "en" => "Service sent by me"
                ],
                "description" => [
                    "ar" => "هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.",
                    "en" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
                ],
                "icon" => public_path("test_images/services/service-01.png"),
                "serviceUsages" => [
                    [
                        "title" => [
                            "ar" => "اكتب تفاصيل طلبك",
                            "en"  => "Write your order details"
                        ],
                        "description" => [
                            "ar" => "قم بادخال تفاصيل الطلب الخاص بك بدقة للحصول على أفضل خدمة ممكنة",
                            "en"  => "Enter your order details accurately To get the best possible service"
                        ],
                        "icon" => public_path("test_images/services/usage-01.png")
                    ],
                    [
                        "title" => [
                            "ar" => "أختر العناوين للشراء والتسليم",
                            "en"  => "Choose addresses for purchase and delivery"
                        ],
                        "description" => [
                            "ar" => "قم باختيار موقع شراء طلبك ومن ثم حدد موقعك لاستلام الطلب",
                            "en"  => "Choose the location to purchase your order and then select your location to receive the order"
                        ],
                        "icon" => public_path("test_images/services/usage-02.png")
                    ],
                    [
                        "title" => [
                            "ar" => "أستقبل العروض واختر الافضل",
                            "en"  => "Receive offers and choose the best"
                        ],
                        "description" => [
                            "ar" => "قم باختيار العرض المناسب لك من العروض المقدمة لك بخصوص طلبك",
                            "en"  => "Choose the appropriate offer for you from the offers presented to you regarding your request"
                        ],
                        "icon" => public_path("test_images/services/usage-03.png")
                    ],
                    [
                        "title" => [
                            "ar" => "تتبع طلبك لحين الاستلام",
                            "en"  => "Track your order until receipt"
                        ],
                        "description" => [
                            "ar" => "قم بمتابعة طلبك على الخريطة لمتابعة سير الأمور على اكمل وجه",
                            "en"  => "Follow your request on the map to follow the progress of things to the fullest"
                        ],
                        "icon" => public_path("test_images/services/usage-04.png")
                    ]
                ]
            ]
        ];

        foreach ($services as $service) {

            $createdServices = Service::query()->create([
                "title" => $service['title'],
                'status' => 1,
            ]);

            foreach ($service["serviceUsages"] as $serviceUsage)

            $createdServiceUsage = $createdServices->serviceUsages()->create([
                "title" => $serviceUsage["title"],
                "description" => $serviceUsage["description"],
            ]);


        }
    }
}
