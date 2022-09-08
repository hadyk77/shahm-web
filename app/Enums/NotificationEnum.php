<?php

namespace App\Enums;

enum NotificationEnum
{

    const NEW_USER_REGISTER = "NEW_USER_REGISTER";
    const NEW_CONTACT_MESSAGE = "NEW_CONTACT_MESSAGE";
    const USER_CUSTOM_MESSAGE = "USER_CUSTOM_MESSAGE";

    public static function notificationTypes(): array
    {
        return [
            self::NEW_USER_REGISTER => __("New User Registered"),
            self::NEW_CONTACT_MESSAGE => __("New Contact Message"),
            self::USER_CUSTOM_MESSAGE => __("User Custom Message"),
        ];
    }

}
