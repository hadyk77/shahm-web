<?php

namespace App\Http\Controllers\API\V1\Offer;

use App\Enums\DiscountEnum;
use App\Enums\OfferEnum;
use App\Enums\OrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Offer\OfferResource;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Notifications\Order\OfferAcceptedNotification;
use App\Notifications\Order\OfferRejectedNotification;
use App\Services\Chat\ChatServices;
use App\Services\Discount\DiscountServices;
use App\Services\Order\OrderServices;
use Auth;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function __construct(private readonly ChatServices $chatServices)
    {
    }

    public function index($order_id)
    {
        $order = Order::query()->where("user_id", Auth::id())->findOrFail($order_id);
        $offers = $order->offers;
        return $this::sendSuccessResponse(OfferResource::collection($offers));
    }

    public function acceptOffer($order_id, $offer_id)
    {
        $order = Order::query()->where("user_id", Auth::id())->findOrFail($order_id);

        $offer = $order->offers()->findOrFail($offer_id);

        if ($offer->offer_status == OfferEnum::ACCEPTED) {

            return $this::sendFailedResponse(__("Order is already accepted by another captain"));

        }

        if ($order->order_status == OrderEnum::IN_PROGRESS) {

            return $this::sendFailedResponse(__("Order is in progress status"));

        }

        if ($order->order_status != OrderEnum::WAITING_OFFERS) {

            return $this::sendFailedResponse(__("Order is not in waiting offer status"));

        }

        $gs = GeneralSetting::query()->first();

        $discountAmount = 0;

        if ($order->discount_code) {
            $discountServices = new DiscountServices();
            $discount = $discountServices->checkIfCouponIsVerified($order->discount_code);
            if ($discount){
                if ($discount->type == DiscountEnum::AMOUNT) {
                    $discountAmount = $discount->amount;
                }
                if ($discount->type == DiscountEnum::PERCENTAGE) {
                    $discountAmount = $offer->offer_total_cost * ( $discount->percentage / 100 );
                }
            }
        }

        $order->update([
            "offer_id" => $offer->id,
            "order_status" => OrderEnum::IN_PROGRESS,
            "captain_id" => $offer->captain_id,
            "captain_profit" => $offer->offer_total_cost - $offer->app_profit_from_user - $offer->app_profit_from_captain,
            "app_profit_from_captain" => $offer->app_profit_from_captain,
            "app_profit_from_user" => $offer->app_profit_from_user,
            "delivery_cost_with_user_commission" => $offer->offer_total_cost,
            "delivery_cost_without_user_commission" => $offer->offer_total_cost - $offer->app_profit_from_user,
            "grand_total" => (1 + ($gs->tax / 100)) * $offer->offer_total_cost,
            "tax" => ($gs->tax / 100) * $offer->offer_total_cost,
            'discount_amount' => $discountAmount
        ]);

        $offer->update([
            "offer_status" => OfferEnum::ACCEPTED,
        ]);

        $offer->refresh();

        $order->refresh();

        $offer->captain->notify(new OfferAcceptedNotification($offer));

        (new OrderServices())->storeHistoryForOrder($order);

        $this->chatServices->startChat($order);

        return $this::sendSuccessResponse([], __("Offer Accepted"));
    }

    public function rejectOffer($order_id, $offer_id)
    {
        $order = Order::query()->where("user_id", Auth::id())->findOrFail($order_id);

        $offer = $order->offers()->findOrFail($offer_id);

        if ($order->order_status != OrderEnum::WAITING_OFFERS) {

            return $this::sendFailedResponse(__("Order is not in waiting offer status"));

        }

        $offer->update([
            "offer_status" => OfferEnum::REJECTED,
        ]);

        $offer->captain->notify(new OfferRejectedNotification($offer));

        return $this::sendSuccessResponse([], __("Offer Rejected"));
    }
}
