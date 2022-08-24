<?php

namespace App\Layouts\Admin;

use App\Enums\StatusEnum;

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
                "title" => __("General Settings"),
                "canShow" => true,
                "menu" => [
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
                                "route" => route("admin.country.index", ["status" => StatusEnum::DEACTIVATED]),
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
                    ]
                ]
            ]
        ];
    }
}
