<?php

namespace App\Layouts\Admin;

use App\Enums\StatusEnum;
use App\Models\Service;
use Cache;

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
                "canShow" => true,
                "menu" => [
                    [
                        "name" => __("Orders"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Orders"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Waiting Offers"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("In Way Orders"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Completed Orders"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Canceled Orders"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                        ]
                    ]
                ]
            ],
            [
                "title" => __("Services"),
                "canShow" => true,
                "menu" => [
                    [
                        "name" => __("Services"),
                        "route" => route("admin.service.index"),
                        "canShow" => true,
                    ],
                    [
                        "name" => __("Services Rates"),
                        "route" => '#',
                        "canShow" => true,
                        "sub_menu" => self::services(),
                    ],
                ]
            ],
            [
                "title" => __("Users"),
                "canShow" => true,
                "menu" => [
                    [
                        "name" => __("Clients"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All clients"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Inactive clients"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Add new client"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Client Rates"),
                                "route" => "#",
                                "canShow" => true,
                            ]
                        ]
                    ],
                    [
                        "name" => __("Captains"),
                        "route" => "#",
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All captain"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Inactive captain"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Add new captain"),
                                "route" => "#",
                                "canShow" => true,
                            ],
                            [
                                "name" => __("Captain Rates"),
                                "route" => "#",
                                "canShow" => true,
                            ]
                        ],
                    ],
                    [
                        "name" => __("Captain Verifications"),
                        "route" => "#",
                        "canShow" => true,
                        "badge" => [
                            "id" => "captain_verifications",
                            "count" => 15,
                            "color" => "danger",
                            "show" => true,
                        ],
                    ]
                ]
            ],
            [
                "title" => __("Coupons"),
                "canShow" => true,
                "menu" => [
                    [
                        "name" => __("Coupons"),
                        "route" => route("admin.service.index"),
                        "canShow" => true,
                        "sub_menu" => [
                            [
                                "name" => __("All Coupons"),
                                "route" => "#",
                            ],
                            [
                                "name" => __("Inactive Coupons"),
                                "route" => "#",
                            ],
                            [
                                "name" => __("Add New Coupon"),
                                "route" => "#",
                            ],
                        ]
                    ],
                    [
                        "name" => __("Coupons Usages"),
                        "route" => "#",
                        "canShow" => true,
                    ],
                ]
            ],
            [
                "title" => __("General Settings"),
                "canShow" => true,
                "menu" => [
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
                                "route" => "#",
                            ],
                            [
                                "name" => __("Services Commissions"),
                                "route" => "#",
                            ],
                            [
                                "name" => __("Payment Settings"),
                                "route" => "#",
                            ],
                            [
                                "name" => __("Social Media Links"),
                                "route" => "#",
                            ],
                            [
                                "name" => __("Firebase Setting"),
                                "route" => "#",
                            ],
                            [
                                "name" => __("Default Images"),
                                "route" => "#",
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
