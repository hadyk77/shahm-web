<?php

namespace App\Enums;

enum NotificationEnum
{

    const NEW_USER_REGISTER = "NEW_USER_REGISTER";
    const NEW_CONTACT_MESSAGE = "NEW_CONTACT_MESSAGE";
    const USER_CUSTOM_MESSAGE = "USER_CUSTOM_MESSAGE";
    const NEW_ORDER_REQUEST = "NEW_ORDER_REQUEST";
    const YOUR_ORDER_RECEIVED = "YOUR_ORDER_RECEIVED";
    const NEW_OFFER = "NEW_OFFER";
    const OFFER_ACCEPTED = "OFFER_ACCEPTED";
    const OFFER_REJECTED = "OFFER_REJECTED";

    public static function notificationTypes(): array
    {
        return [
            self::NEW_USER_REGISTER => __("New User Registered"),
            self::NEW_CONTACT_MESSAGE => __("New Contact Message"),
            self::USER_CUSTOM_MESSAGE => __("User Custom Message"),
            self::NEW_ORDER_REQUEST => __("New Order Request"),
            self::YOUR_ORDER_RECEIVED => __("Your Order Received"),
            self::NEW_OFFER => __("Your order has new offer"),
            self::OFFER_ACCEPTED => __("Your offer has been accepted 🎉"),
            self::OFFER_REJECTED => __("Your offer has been rejected"),
        ];
    }

}
