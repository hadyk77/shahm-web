<?php

namespace App\Http\Controllers\API\V1\Offer;

use App\Enums\OfferEnum;
use App\Enums\OrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Offer\OfferResource;
use App\Models\Order;
use App\Notifications\Order\OfferAcceptedNotification;
use App\Notifications\Order\OfferRejectedNotification;
use Auth;
use Illuminate\Http\Request;

class OfferController extends Controller
{
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

        if ($order->order_status == OrderEnum::IN_PROGRESS) {

            return $this::sendFailedResponse(__("Order is in progress status"));

        }

        if ($order->order_status != OrderEnum::WAITING_OFFERS) {

            return $this::sendFailedResponse(__("Order is not in waiting offer status"));

        }

        $order->update([
            "offer_id" => $offer->id,
            "order_status" => OrderEnum::IN_PROGRESS,
            "captain_id" => $offer->captain_id
        ]);

        $offer->update([
            "offer_status" => OfferEnum::ACCEPTED,
        ]);

        $offer->refresh();

        $offer->captain->notify(new OfferAcceptedNotification($offer));

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
