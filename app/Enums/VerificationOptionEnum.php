<?php

namespace App\Enums;

enum VerificationOptionEnum
{
    const ICON = "icon";

    const ICON_ACTIVE = "icon_active";

    public static function relatedOrders(): array
    {
        return [
            "food" => __('Food'),
            "products" => __("Products"),
            "all" => __('Contain All')
        ];
    }

}
