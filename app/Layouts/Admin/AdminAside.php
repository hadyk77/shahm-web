<?php

namespace App\Layouts\Admin;

class AdminAside
{
    public static function links(): array
    {
        return [
            [
                "name" => __("Dashboard"),
                "route"  => route("admin.dashboard.index"),
                "canShow"  => true,
            ]
        ];
    }
}
