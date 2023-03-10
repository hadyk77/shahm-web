<?php

namespace App\Layouts\Admin;

use App\Enums\StatusEnum;
use App\Models\Service;
use Cache;
use DB;
use Gate;

class AdminAside
{
    public static function links(): array
    {
        return [
            [
                "name" => __("Dashboard"),
                "route" => route("admin.dashboard.index"),
                "canShow" => true,
            ],
            [
                "title" => __("Orders"),
                "canShow" => Gate::allows("orders"),
                "menu" => [
                    [
                        "name" => __("Orders"),
                        "route" => route('admin.order.index'),
                        "canShow" => true,
                    ]
                ]
            ],
            [
                "title" => __("Transactions"),
                "canShow" => Gate::allows("transactions"),
                "menu" => [
                    [
                        "name" => __("Transactions"),
                        "route" => route('admin.transactions.index'),
                        "canShow" => true,
                    ]
                ]
            ],
            [
                "title" => __("Services"),
                "canShow" => Gate::allows("services"),
                "menu" => [
                    [
                        "name" => __("Services"),
                        "route" => route("admin.service.index"),
                        "canShow" => true,
                    ]
                ]
            ],
            [
                "title" => __("Users"),
                "canShow" => Gate::allows("users"),
                "menu" => [
                    [
                        "name" => __("Clients"),
                        "route" => route('admin.user.index'),
                        "canShow" => true,
                    ],
                    [
                        "name" => __("Captains"),
                        "route" => route('admin.captain.index'),
                        "canShow" => true,
                    ],
                    [
                        "name" => __("Captain Verifications"),
                        "route" => route('admin.verification-files.index'),
                        "canShow" => true,
                        "badge" => [
                            "id" => "captain_verifications",
                            "count" => DB::table("captain_verification_files")->where("is_read", 0)->count(),
                            "color" => "danger",
                            "show" => true,
                        ],
                    ]
                ]
            ],
            [
                "title" => __("Contacts"),
                "canShow" => Gate::allows("contact_us"),
                "menu" => [
                    [
                        "name" => __("Contact Types"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Contact Types"),
                                "route" => route('admin.contact-type.index'),
                            ],
                            [
                                "name" => __("Add New Contact Type"),
                                "route" => route('admin.contact-type.create'),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Contact Messages"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Messages"),
                                "route" => route("admin.contact.index"),
                            ],
                            [
                                "name" => __("UnRead Messages"),
                                "route" => route("admin.contact.index", ["status" => "unread"]),
                            ],
                            [
                                "name" => __("Read Messages"),
                                "route" => route("admin.contact.index", ["status" => "read"]),
                            ],
                        ]
                    ]
                ]
            ],
            [
                "title" => __("Marketing"),
                "canShow" => Gate::allows("marketing"),
                "menu" => [
                    [
                        "name" => __("Coupons"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Discounts"),
                                "route" => route('admin.discount.index'),
                            ],
                            [
                                "name" => __("Inactive Discounts"),
                                "route" => route('admin.discount.index', ['status' => StatusEnum::DEACTIVATED]),
                            ],
                            [
                                "name" => __("Add New Discount"),
                                "route" => route('admin.discount.create'),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Banners"),
                        "route" => route("admin.banner.index"),
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Banners"),
                                "route" => route("admin.banner.index"),
                            ],
                            [
                                "name" => __("Inactive Banners"),
                                "route" => route("admin.banner.index", ["status" => StatusEnum::DEACTIVATED]),
                            ],
                            [
                                "name" => __("Add New Banner"),
                                "route" => route("admin.banner.create"),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Intro Images"),
                        "route" => route("admin.intro-image.index"),
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Intro Images"),
                                "route" => route("admin.intro-image.index"),
                            ],
                            [
                                "name" => __("Inactive Intro Images"),
                                "route" => route("admin.intro-image.index", ["status" => StatusEnum::DEACTIVATED]),
                            ],
                            [
                                "name" => __("Add New Intro Image"),
                                "route" => route("admin.intro-image.create"),
                            ],
                        ]
                    ],
                ]
            ],
            [
                "title" => __("Staff & Permissions"),
                "canShow" => Gate::allows("staff"),
                "menu" => [
                    [
                        "name" => __("Permissions"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Permissions"),
                                "route" => route('admin.role.index'),
                            ],
                            [
                                "name" => __("Add New Permission"),
                                "route" => route('admin.role.create'),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Staff"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Staff"),
                                "route" => route("admin.staff.index"),
                            ],
                            [
                                "name" => __("Add New Staff"),
                                "route" => route("admin.staff.create"),
                            ],
                        ]
                    ]
                ]
            ],
            [
                "title" => __("General Settings"),
                "canShow" => Gate::allows("general_setting"),
                "menu" => [
                    [
                        "name" => __("Translation Center"),
                        "route" => route('admin.translation.index'),
                        "canShow" => true,
                    ],
                    [
                        "name" => __("Cancel Reason"),
                        "route" => route('admin.cancel-reason.index'),
                        "canShow" => true,
                    ],
                    [
                        "name" => __("Expected Price Ranges"),
                        "route" => route('admin.expected-price-range.index'),
                        "canShow" => true,
                    ],
                    [
                        "name" => __("Upgrade options"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Options"),
                                "route" => route('admin.upgrade-options.index'),
                            ],
                            [
                                "name" => __("Add new option"),
                                "route" => route('admin.upgrade-options.create'),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Verification files"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All files"),
                                "route" => route('admin.verification-options.index'),
                            ],
                            [
                                "name" => __("Add new file"),
                                "route" => route('admin.verification-options.create'),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Countries"),
                        "route" => route("admin.country.index"),
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Countries"),
                                "route" => route("admin.country.index"),
                            ],
                            [
                                "name" => __("Inactive Countries"),
                                "route" => route("admin.country.index", ["status" => StatusEnum::DEACTIVATED]),
                            ],
                            [
                                "name" => __("Add New Country"),
                                "route" => route("admin.country.create"),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Governorates"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Governorates"),
                                "route" => route('admin.governorate.index'),
                            ],
                            [
                                "name" => __("Inactive Governorates"),
                                "route" => route('admin.governorate.index', ["status" => StatusEnum::DEACTIVATED]),
                            ],
                            [
                                "name" => __("Add New Governorate"),
                                "route" => route('admin.governorate.create'),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Pages"),
                        "route" => route("admin.page.index"),
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Pages"),
                                "route" => route("admin.page.index"),
                            ],
                            [
                                "name" => __("Inactive Pages"),
                                "route" => route("admin.page.index", ["status" => StatusEnum::DEACTIVATED]),
                            ],
                            [
                                "name" => __("Add New Page"),
                                "route" => route("admin.page.create"),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Vehicle Types"),
                        "route" => route("admin.vehicle-type.index"),
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Vehicle Types"),
                                "route" => route("admin.vehicle-type.index"),
                            ],
                            [
                                "name" => __("Inactive Vehicle Types"),
                                "route" => route("admin.vehicle-type.index", ["status" => StatusEnum::DEACTIVATED]),
                            ],
                            [
                                "name" => __("Add New Vehicle Type"),
                                "route" => route("admin.vehicle-type.create"),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Nationalities"),
                        "route" => route("admin.nationality.index"),
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Nationalities"),
                                "route" => route("admin.nationality.index"),
                            ],
                            [
                                "name" => __("Inactive Nationalities"),
                                "route" => route("admin.nationality.index", ["status" => StatusEnum::DEACTIVATED]),
                            ],
                            [
                                "name" => __("Add New Nationality"),
                                "route" => route("admin.nationality.create"),
                            ],
                        ]
                    ],
                    [
                        "name" => __("Settings"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("Basic Information"),
                                "route" => route('admin.settings.basic-information.index'),
                            ],
                            [
                                "name" => __("App Commissions"),
                                "route" => route('admin.settings.app-commission.index'),
                            ],
                            [
                                "name" => __("Payment Settings"),
                                "route" => route('admin.settings.payment-options.index'),
                            ],
                            [
                                "name" => __("Social Media Links"),
                                "route" => route('admin.settings.social-media.index'),
                            ],
                            [
                                "name" => __("Firebase Setting"),
                                "route" => route('admin.settings.firebase.index'),
                            ],
                            [
                                "name" => __("Default Images"),
                                "route" => route('admin.settings.default-images.index'),
                            ],
                            [
                                "name" => __("Translations"),
                                "route" => "/admin/translations/ar/translations",
                            ],
                        ]
                    ]
                ]
            ]
        ];
    }

    public static function services(): array
    {
        return Cache::rememberForever("services", function () {
            $services = [];
            foreach (Service::query()->get() as $service) {
                $services[] = [
                    "name" => $service->title,
                    "route" => route("admin.service.rate.index", $service->id),
                    "canShow" => true,
                ];
            }
            return $services;
        });
    }

}
