<?php

namespace App\Enums;

enum OrderEnum
{
    const WAITING_OFFERS = "waiting_offers";

    const IN_PROGRESS = "in_progress";

    const DELIVERED = "delivered";

    const CANCELED = "canceled";

    public static function statues(): array
    {
        return [
            self::WAITING_OFFERS => __("Waiting Offers"),
            self::IN_PROGRESS => __("In Progress"),
            self::DELIVERED => __("Delivered"),
            self::CANCELED => __("Canceled")
        ];
    }

}
