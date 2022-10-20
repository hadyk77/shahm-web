<?php

namespace App\Services\Chat;

use App\Enums\ChatEnum;
use App\Http\Requests\API\Chat\ChatMessageRequest;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Order;
use Auth;
use DB;

class ChatServices
{
    public function getMessages($order_id)
    {
        $chat = self::chatDetails($order_id)["chat"];
        return $chat->chatMessages()->latest("chat_messages.created_at")->get();
    }

    public function sendMessage(ChatMessageRequest $request, $order_id, $sender_id, $receiver_id)
    {
        $chat = self::chatDetails($order_id)["chat"];

        return DB::transaction(function () use ($request, $chat, $sender_id, $receiver_id) {

            $message = ChatMessage::query()->create([
                "chat_id"  => $chat->id,
                "sender_id"  => $sender_id,
                "receiver_id"  => $receiver_id,
                "type"  => $request->type,
                "message_text"  => $request->type == "text" ? $request->message_text : null,
                "lat"  => $request->type == "location" ? $request->get("location.lat") : null,
                "long"  => $request->type == "location" ? $request->get("location.long") : null,
                "links"  => $request->links,
            ]);

            if ($request->type == "images" && $request->filled("images")) {
                foreach ($request->images as $image) {
                    $chat->addMedia($image)->toMediaCollection(ChatEnum::CHAT_IMAGES);
                }
            }

            if ($request->type == "audios") {
                foreach ($request->audios as $audios) {
                    $chat->addMedia($audios)->toMediaCollection(ChatEnum::CHAT_AUDIOS);
                }
            }

        });
    }

    private static function chatDetails($order_id): array
    {
        $order = Order::query()->where("user_id", Auth::id())->findOrFail($order_id);
        $chat = Chat::query()->where("client_id", Auth::id())->where("order_id", $order_id)->firstOrFail();
        return [
            "order" => $order,
            "chat" => $chat
        ];
    }

}
