<?php

namespace App\Services\Chat;

use App\Enums\ChatEnum;
use App\Enums\OrderEnum;
use App\Helper\Helper;
use App\Http\Requests\API\Chat\ChatMessageRequest;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\GeneralSetting;
use App\Models\Offer;
use App\Models\Order;
use App\Notifications\Chat\ChatMessageNotification;
use Auth;
use DB;
use http\Message;
use Illuminate\Support\Collection;
use Str;

class ChatServices
{
    public function getMessages($order_id)
    {
        $chat = self::chatDetails($order_id)["chat"];
        return $chat->chatMessages()->latest("chat_messages.created_at")->get();
    }

    public function singleMessage($order_id, $message_id)
    {
        $chat = self::chatDetails($order_id)["chat"];
        return $chat->chatMessages()->where("chat_messages.id", $message_id)->firstOrFail();
    }

    public function sendMessage(ChatMessageRequest $request, $order_id, $sender_id, $receiver_id)
    {
        $chat = self::chatDetails($order_id)["chat"];

        return DB::transaction(function () use ($request, $chat, $sender_id, $receiver_id) {

            $message = ChatMessage::query()->create([
                "chat_id" => $chat->id,
                "sender_id" => $sender_id,
                "receiver_id" => $receiver_id,
                "type" => $request->type,
                "message_text" => $request->type == "text" ? $request->message_text : null,
                "lat" => $request->type == "location" ? $request->input("location.lat") : null,
                "long" => $request->type == "location" ? $request->input("location.long") : null,
                "need_style" => $request->type == "location",
                "style_type" => $request->type == "location" ? ChatEnum::SHARE_LOCATION_STYLE : null,
                "links" => $request->links,
            ]);

            if ($request->type == "images" && $request->has("images") && count($request->images) > 0) {
                foreach ($request->images as $image) {
                    $message->addMedia($image)->toMediaCollection(ChatEnum::CHAT_IMAGES);
                }
            }

            if ($request->type == "audios" && $request->has("audios") && count($request->audios) > 0) {
                foreach ($request->audios as $audios) {
                    $message->addMedia($audios)->toMediaCollection(ChatEnum::CHAT_AUDIOS);
                }
            }

            $title = __("Message From") . " " . $message->sender->name;
            $body = $request->message_text ?? __("New Message");

            $message->receiver?->notify(new ChatMessageNotification($title, $body, $chat->order_id));

            return $message;
        });
    }

    private static function chatDetails($order_id): array
    {
        if (Auth::user()->is_captain) {
            $order = Order::query()->where("captain_id", Auth::id())->findOrFail($order_id);
            $chat = Chat::query()->where("captain_id", Auth::id())->where("order_id", $order_id)->firstOrFail();
        } else {
            $order = Order::query()->where("user_id", Auth::id())->findOrFail($order_id);
            $chat = Chat::query()->where("client_id", Auth::id())->where("order_id", $order_id)->firstOrFail();
        }
        return [
            "order" => $order,
            "chat" => $chat
        ];
    }

    public function startChat(Order $order): void
    {
        $chat = Chat::query()->create([
            "uuid" => Str::uuid()->toString(),
            "order_id" => $order->id,
            "client_id" => $order->user_id,
            "captain_id" => $order->captain_id,
            "service_id" => $order->service_id,
        ]);

        // First Message
        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->client_id,
            "receiver_id" => $chat->captain_id,
            "message_text" => Str::replace(",", " \n ", $order->order_items),
            "type" => 'text',
        ]);


        // Second Message
        $googleDistanceDetails = Helper::getLocationDetailsFromGoogleMapApi(
            fromLat: $chat->captain->address_lat,
            fromLng: $chat->captain->address_long,
            toLat: $chat->order->pickup_location_lat,
            toLng: $chat->order->pickup_location_long,
        );
        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->captain_id,
            "receiver_id" => $chat->client_id,
            "type" => 'text',
            "need_style" => true,
            "style_type" => ChatEnum::DISTANCE_DURATION_COST_STYLE,
            "delivery_cost" => $order->delivery_cost_with_user_commission,
            "delivery_duration" => $googleDistanceDetails["durationValue"],
            "delivery_distance" => $googleDistanceDetails["distanceValue"],
        ]);


        // Third Message
        $helloMessage = "أهلا معك ";
        $helloMessage .= " \n ";
        $helloMessage .= $order->captain->name;
        $helloMessage .= " \n ";
        $helloMessage .= "يسعدني ان أخدمك اليوم. أرجو منك التأكيد";

        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->captain_id,
            "receiver_id" => $chat->client_id,
            "message_text" => $helloMessage,
            "type" => 'text',
        ]);


        // Fourth message
        $gs = GeneralSetting::query()->first();
        if ($gs->warning_message) {
            ChatMessage::query()->create([
                "chat_id" => $chat->id,
                "sender_id" => $chat->captain_id,
                "receiver_id" => $chat->client_id,
                "message_text" => $gs->warning_message,
                "need_style" => true,
                "style_type" => ChatEnum::ADMIN_WARNING_MESSAGE_STYLE,
                "type" => 'text',
            ]);
        }


        if ($order->pickup_location_long && $order->pickup_location_long){
            ChatMessage::query()->create([
                "chat_id" => $chat->id,
                "sender_id" => $chat->captain_id,
                "receiver_id" => $chat->client_id,
                "lat" => $order->pickup_location_lat,
                "long" => $order->pickup_location_long,
                "need_style" => true,
                "style_type" => ChatEnum::ORDER_PICK_LOCATION_STYLE,
                "type" => 'location',
            ]);
        }

        if ($order->drop_off_location_lat && $order->drop_off_location_long){
            ChatMessage::query()->create([
                "chat_id" => $chat->id,
                "sender_id" => $chat->captain_id,
                "receiver_id" => $chat->client_id,
                "lat" => $order->drop_off_location_lat,
                "long" => $order->drop_off_location_long,
                "need_style" => true,
                "style_type" => ChatEnum::ORDER_DROP_OFF_LOCATION_STYLE,
                "type" => 'location',
            ]);
        }
    }

    public function sendOfferMessage(Offer $offer): ChatMessage
    {
        $chat = $offer->order->chat;

        $googleDistanceDetails = Helper::getLocationDetailsFromGoogleMapApi(
            fromLat: $chat->captain->address_lat,
            fromLng: $chat->captain->address_long,
            toLat: $chat->order->pickup_location_lat,
            toLng: $chat->order->pickup_location_long,
        );

        $message = ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $offer->captain_id,
            "receiver_id" => $offer->order->user_id,
            "message_text" => null,
            "type" => 'text',
            "need_style" => true,
            "style_type" => ChatEnum::OFFER_FROM_CAPTAIN_STYLE,
            "delivery_cost" => $offer->offer_total_cost,
            "offer_id" => $offer->id,
            "delivery_duration" => $googleDistanceDetails["durationValue"],
            "delivery_distance" => $googleDistanceDetails["distanceValue"],
        ]);

        $title = __("Message From") . " " . $message->sender->name;
        $body = __("Offer for order") . " " . $chat->order->order_code;

        $message->receiver?->notify(new ChatMessageNotification($title, $body, $chat->order_id));

        return $message;

    }

    public function createBetweenGovernorateChat(Order $order): void
    {
        $chat = Chat::query()->create([
            "uuid" => Str::uuid()->toString(),
            "order_id" => $order->id,
            "client_id" => $order->user_id,
            "captain_id" => $order->captain_id,
            "service_id" => $order->service_id,
        ]);



        // First Message
        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->client_id,
            "receiver_id" => $chat->captain_id,
            "message_text" => Str::replace(",", " \n ", $order->order_items),
            "type" => 'text',
        ]);


        // Second Message
        $googleDistanceDetails = Helper::getLocationDetailsFromGoogleMapApi(
            fromLat: $chat->captain->address_lat,
            fromLng: $chat->captain->address_long,
            toLat: $chat->order->pickup_location_lat,
            toLng: $chat->order->pickup_location_long,
        );
        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->captain_id,
            "receiver_id" => $chat->client_id,
            "type" => 'text',
            "need_style" => true,
            "style_type" => ChatEnum::DISTANCE_DURATION_COST_STYLE,
            "delivery_cost" => $order->delivery_cost_with_user_commission,
            "delivery_duration" => $googleDistanceDetails["durationValue"],
            "delivery_distance" => $googleDistanceDetails["distanceValue"],
        ]);


        // Third Message
        $helloMessage = "أهلا معك ";
        $helloMessage .= " \n ";
        $helloMessage .= $order->captain->name;
        $helloMessage .= " \n ";
        $helloMessage .= "يسعدني ان أخدمك اليوم. أرجو منك التأكيد";

        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->captain_id,
            "receiver_id" => $chat->client_id,
            "message_text" => $helloMessage,
            "type" => 'text',
        ]);


        // Fourth message
        $gs = GeneralSetting::query()->first();
        if ($gs->warning_message) {
            ChatMessage::query()->create([
                "chat_id" => $chat->id,
                "sender_id" => $chat->captain_id,
                "receiver_id" => $chat->client_id,
                "message_text" => $gs->warning_message,
                "need_style" => true,
                "style_type" => ChatEnum::ADMIN_WARNING_MESSAGE_STYLE,
                "type" => 'text',
            ]);
        }

        if ($order->pickup_location_long && $order->pickup_location_long){
            ChatMessage::query()->create([
                "chat_id" => $chat->id,
                "sender_id" => $chat->captain_id,
                "receiver_id" => $chat->client_id,
                "lat" => $order->pickup_location_lat,
                "long" => $order->pickup_location_long,
                "need_style" => true,
                "style_type" => ChatEnum::ORDER_PICK_LOCATION_STYLE,
                "type" => 'location',
            ]);
        }

        if ($order->drop_off_location_lat && $order->drop_off_location_long){
            ChatMessage::query()->create([
                "chat_id" => $chat->id,
                "sender_id" => $chat->captain_id,
                "receiver_id" => $chat->client_id,
                "lat" => $order->drop_off_location_lat,
                "long" => $order->drop_off_location_long,
                "need_style" => true,
                "style_type" => ChatEnum::ORDER_DROP_OFF_LOCATION_STYLE,
                "type" => 'location',
            ]);
        }

    }

    public function sendExportInvoiceMessage(Order $order, $request)
    {
        $messages = new Collection();

        if ($request->hasFile("purchasing_image")) {
            $purchasingImageMessage = ChatMessage::query()->create([
                "chat_id" => $order->chat->id,
                "sender_id" => $order->captain_id ,
                "receiver_id" => $order->user_id,
                "type" => 'images',
            ]);
            $purchasingImageMessage->addMedia($request->purchasing_image)->toMediaCollection(ChatEnum::CHAT_IMAGES);
            $messages->push($purchasingImageMessage);
        }

        $message = ChatMessage::query()->create([
            "chat_id" => $order->chat->id,
            "sender_id" => $order->captain_id ,
            "receiver_id" => $order->user_id,
            "message_text" => "تم إصدار فاتورة التوصيل قم بتحميلها",
            "type" => 'text',
            "need_style" => true,
            "style_type" => ChatEnum::EXPORT_INVOICE_STYLE,
            "links" => [
                [
                    "method" => "get",
                    "route" => "/download-invoice/" . $order->id,
                ],
            ]
        ]);

        $messages->push($message);

        $title = __("Message From") . " " . $message->sender->name;
        $body = __("The delivery invoice has been issued. Download it");

        $message->receiver?->notify(new ChatMessageNotification($title, $body, $order->id));

        return $messages;
    }
}
