<?php

namespace App\Actions\NotificationActions;

use App\Models\Captain;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\User;
use App\Notifications\Order\NewOfferNotification;
use App\Notifications\Order\NewOrderNotification;
use App\Support\CalculateDistanceBetweenTwoPoints;
use DB;
use Lorisleiva\Actions\Concerns\AsAction;

class NotifyNearCaptainsWithNewOrderAction
{
    use AsAction;

    public function handle(Order $order): void
    {
        $lat = $order->pickup_location_lat;
        $long = $order->pickup_location_long;
        $max_radius = GeneralSetting::query()->first()->max_radius;
        $captainIds = DB::table("users")
            ->where("is_captain", 1)
            ->where("is_captain_phone_number_verified", 1)
            ->where("captain_status", 1)
            ->where("status", 1)
            ->select("users.id", DB::raw(
                "(ST_Distance_sphere(
                    point($long,$lat),
                    point(users.address_long, users.address_lat)
                ) / 1000) as distance"
            ))
            ->having('distance', '<=', $max_radius)
            ->get()
            ->pluck("id");
        foreach ($captainIds as $captainId) {
            $captain = User::query()->whereRelation("captain", "captains.enable_order", 1)->find($captainId);
            $captain?->notify(new NewOrderNotification($order));
        }
    }
}
