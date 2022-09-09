<?php

namespace App\Enums;

use App\Models\GeneralSetting;

enum OrderEnum
{
    const WAITING_OFFERS = "waiting_offers";

    const IN_PROGRESS = "in_progress";

    const DELIVERED = "delivered";

    const CANCELED = "canceled";

    const UNPAID = "unpaid";

    const PAID = "paid";

    const WALLET = "wallet";

    const CREDIT_CARD = "credit_card";

    const CASH = "cash";

    public static function statues(): array
    {
        return [
            self::WAITING_OFFERS => __("Waiting Offers"),
            self::IN_PROGRESS => __("In Progress"),
            self::DELIVERED => __("Delivered"),
            self::CANCELED => __("Canceled")
        ];
    }

    public static function enabledPaymentMethods(): array
    {
        $gs = GeneralSetting::query()->first();
        $paymentMethods = [];
        if ($gs->is_credit_card_enabled) {
            $paymentMethods[] = [
                self::CREDIT_CARD => __("Credit Cart"),
            ];
        }
        if ($gs->is_wallet_enabled) {
            $paymentMethods[] = [
                self::WALLET => __("Wallet"),
            ];
        }
        if ($gs->is_cash_enabled) {
            $paymentMethods[] = [
                self::CASH => __("Cash")
            ];
        }
        return $paymentMethods;
    }

    public static function paymentMethods(): array
    {
        return [
            self::WALLET => __("Wallet"),
            self::CREDIT_CARD => __("Credit Cart"),
            self::CASH => __("Cash")
        ];
    }

}
