<?php

namespace App\Actions\NotificationActions;

use App\Helper\Helper;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Order\NewOrderNotification;
use Log;
use Lorisleiva\Actions\Concerns\AsAction;

class NotifyNearCaptainsWithNewOrderAction
{
    use AsAction;

    public function handle(Order $order, $excludeCaptainId = null): void
    {
        $max_radius = (float)GeneralSetting::query()->first()->max_radius;
        $captains = User::query()
            ->where("is_captain", 1)
            ->where("is_captain_phone_number_verified", 1)
            ->where("captain_status", 1)
            ->where("status", 1)
            ->when($excludeCaptainId != null, function ($query) use ($excludeCaptainId) {
                $query->where("users.id", "!=", $excludeCaptainId);
            })
            ->whereHas("captain", function ($query) use ($order) {
                $query->where("captains.enable_order", 1)->whereHas("verificationFiles", function ($query2) use ($order) {
                    $query2
                        ->where("captain_verification_files.status", 1)
                        ->whereNotIn("captain_verification_files.verification_option_id", [1, 2])
                        ->whereHas("option", function ($query3) use ($order) {
                            $query3->where("verification_options.related_orders", $order->order_type);
                        });
                });
            })
            ->get();
        dd($captains);
        foreach ($captains as $captain) {
            $distance = Helper::getLocationDetailsFromGoogleMapApi($captain->address_lat, $captain->address_long, $order->pickup_location_lat, $order->pickup_location_long)["distanceValue"];
            if ($distance <= $max_radius) {
                if ($captain->hasNoOrder()) {
                    $captain->notify(new NewOrderNotification($order));
                    Log::info("Captain with name [" . $captain->name . "] notified with order with code " . $order->order_code);
                }
            }
        }
    }


}
