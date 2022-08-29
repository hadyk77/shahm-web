<?php

namespace App\Enums;

enum NotificationEnum
{

    const NEW_USER_REGISTER = "NEW_USER_REGISTER";

    public static function notificationTypes(): array
    {
        return [
            self::NEW_USER_REGISTER => __("New User Registered")
        ];
    }

}
