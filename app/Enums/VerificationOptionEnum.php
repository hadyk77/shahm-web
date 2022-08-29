<?php

namespace App\Enums;

enum VerificationOptionEnum
{

    const ICON = "icon";

    public static function relatedOrders(): array
    {
        return [
            "food" => __('Food'),
            "products" => __("Products"),
            "all" => __('Contain All')
        ];
    }

}
