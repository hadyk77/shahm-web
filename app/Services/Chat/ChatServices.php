<?php

namespace App\Services\Chat;

use App\Enums\ChatEnum;
use App\Helper\Helper;
use App\Http\Requests\API\Chat\ChatMessageRequest;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Notifications\Chat\ChatMessageNotification;
use Auth;
use DB;
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

        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->client_id,
            "receiver_id" => $chat->captain_id,
            "message_text" => Str::replace(",", " \n ", $order->order_items),
            "type" => 'text',
        ]);

        $orderDeliveryDetails = " تكلفة التوصيل : " . Helper::price($order->delivery_cost);
        $orderDeliveryDetails .= " \n\n ";
        $orderDeliveryDetails .= "التوصيل خلال : ساعة واحدة";
        $orderDeliveryDetails .= " \n\n ";
        $orderDeliveryDetails .= $order->distance . " يبعد : ";

        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->captain_id,
            "receiver_id" => $chat->client_id,
            "message_text" => $orderDeliveryDetails,
            "type" => 'text',
        ]);

        $helloMessage = " أهلا معك ";
        $helloMessage .= " \n ";
        $helloMessage .= $order->captain->name;
        $helloMessage .= " \n\n ";
        $helloMessage .= "يسعدني ان أخدمك اليوم. أرجو منك التأكيد";

        ChatMessage::query()->create([
            "chat_id" => $chat->id,
            "sender_id" => $chat->captain_id,
            "receiver_id" => $chat->client_id,
            "message_text" => $helloMessage,
            "type" => 'text',
        ]);

        $gs = GeneralSetting::query()->first();

        if ($gs->warning_message) {
            ChatMessage::query()->create([
                "chat_id" => $chat->id,
                "sender_id" => $chat->captain_id,
                "receiver_id" => $chat->client_id,
                "message_text" => $gs->warning_message,
                "type" => 'text',
            ]);
        }
    }
}
