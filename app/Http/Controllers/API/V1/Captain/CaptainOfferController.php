<?php

namespace App\Http\Controllers\API\V1\Captain;

use App\Enums\OfferEnum;
use App\Enums\OrderEnum;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatMessagesResource;
use App\Http\Resources\Offer\OfferResource;
use App\Models\BetweenGovernorateService;
use App\Models\ChatMessage;
use App\Models\GeneralSetting;
use App\Models\Offer;
use App\Models\Order;
use App\Notifications\Order\NewOfferNotification;
use App\Services\Chat\ChatServices;
use App\Support\CalculateDistanceBetweenTwoPoints;
use Auth;
use DB;
use Illuminate\Http\Request;

class CaptainOfferController extends Controller
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
            "price" => "required|numeric",
        ]);

        $delivery_types = Helper::getCaptainDeliveryTypes();

        $order = Order::query()
            ->when(!in_array("all", $delivery_types), function ($query) use ($delivery_types) {
                $query->whereIn("order_type", $delivery_types);
            })
            ->where("order_status", OrderEnum::WAITING_OFFERS)
            ->find($order_id);

        if (!$order) {
            return $this::sendFailedResponse(__("Order is not found"));
        }


        if (DB::table("offers")->where("captain_id", Auth::id())->where("order_id", $order->id)->exists()) {

            $oldOfferStatuses = DB::table("offers")
                ->where("captain_id", Auth::id())
                ->where("order_id", $order->id)
                ->pluck("offer_status")
                ->toArray();

            if (in_array(OfferEnum::PENDING, $oldOfferStatuses)) {
                return $this::sendFailedResponse(__("You have pending offer for this order"));
            }

            if (in_array(OfferEnum::ACCEPTED, $oldOfferStatuses)) {
                return $this::sendFailedResponse(__("Your offer is already accepted"));
            }

        }

        if ($order->service_id == 2) {
            $distance = Helper::getLocationDetailsFromGoogleMapApi(
                $order->drop_off_location_lat,
                $order->drop_off_location_long,
                Auth::user()->address_lat,
                Auth::user()->address_long,
            );
        } else{
            $distance = Helper::getLocationDetailsFromGoogleMapApi(
                $order->pickup_location_lat,
                $order->pickup_location_long,
                Auth::user()->address_lat,
                Auth::user()->address_long,
            );
        }

        $offer = Offer::query()->create([
            "service_id" => $order->service_id,
            "order_id" => $order->id,
            "captain_id" => Auth::user()->id,
            "captain_lat" => Auth::user()->address_lat,
            "captain_long" => Auth::user()->address_long,
            "distance" => $distance["distanceValue"],
            "price" => $request->price,
            "app_profit_from_captain" => $this->calculateAppProfit($request->price)["app_profit_from_captain"],
            "app_profit_from_user" => $this->calculateAppProfit($request->price)["app_profit_from_user"],
            "offer_total_cost" => $this->calculateAppProfit($request->price)["total"],
        ]);

        $message = null;

        if ($offer->order->between_governorate_service_id) {

            $betweenGovernorateService = BetweenGovernorateService::query()->find($offer->order->between_governorate_service_id);

            $offer?->update([
                "is_between_governorate_service" => 1,
                "governorate_from_id" => $betweenGovernorateService->pickup_id,
                "governorate_to_id" => $betweenGovernorateService->drop_off_id,
                "between_governorate_date" => $betweenGovernorateService->between_governorate_date . " " . $betweenGovernorateService->between_governorate_time,
            ]);


            if ($offer->order->chat()->count()) {
                $chatService = new ChatServices();
                $message = $chatService->sendOfferMessage($offer);
            }

        }

        $offer->order->client->notify(new NewOfferNotification($offer));

        $offer->refresh();

        if ($message) {
            return $this::sendSuccessResponse([
                "offer" => OfferResource::make($offer),
                "message" => ChatMessagesResource::make($message)
            ]);
        }

        return $this::sendSuccessResponse(OfferResource::make($offer));
    }

    private function calculateAppProfit(float $price)
    {
        $gs = GeneralSetting::query()->first();
        $app_profit_from_captain = $price * $gs->captain_commission / 100;
        $app_profit_from_user = $price * $gs->client_commission / 100;
        return [
            "app_profit_from_captain" => $app_profit_from_captain,
            "app_profit_from_user" => $app_profit_from_user,
            "total" => $price + $app_profit_from_user,
        ];
    }

}
