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
            ]
        ];
    }
}
