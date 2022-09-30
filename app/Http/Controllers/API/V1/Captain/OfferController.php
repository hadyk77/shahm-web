<?php

namespace App\Http\Controllers\API\V1\Captain;

use App\Enums\OrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Offer\OfferResource;
use App\Models\Offer;
use App\Models\Order;
use Auth;
use DB;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::query()->where("captain_id", Auth::id())->get();
        return $this::sendSuccessResponse(OfferResource::collection($offers));
    }

    public function show($id)
    {
        $offer = Offer::query()->where("captain_id", Auth::id())->findOrFail($id);
        return $this::sendSuccessResponse(OfferResource::make($offer));
    }

    public function getOfferByOrder($order_id)
    {
        $offer = Offer::query()->where("captain_id", Auth::id())->where("order_id", $order_id)->firstOrFail();
        return $this::sendSuccessResponse(OfferResource::make($offer));
    }

    public function sendOffer(Request $request, $order_id)
    {

        $this->validate($request, [
            "price" => "required|numeric"
        ]);

        $order = Order::query()->where("order_status", OrderEnum::WAITING_OFFERS)->findOrFail($order_id);

        if (DB::table("offers")->where("captain_id", Auth::id())->where("order_id", $order_id)->exists()) {

            return $this::sendFailedResponse(__("You already send offer"));

        }

        $offer = Offer::query()->create([
            "service_id" => $order->service_id,
            "order_id" => $order->id,
            "captain_id" => Auth::user()->id,
            "price" => $request->price,
        ]);

        return $this::sendSuccessResponse(OfferResource::make($offer));

    }

}
