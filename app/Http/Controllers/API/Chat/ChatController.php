<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Chat\ChatMessageRequest;
use App\Http\Resources\Chat\ChatMessagesResource;
use App\Models\Chat;
use App\Models\Order;
use App\Services\Chat\ChatServices;
use Auth;
use Exception;
use Log;

class ChatController extends Controller
{

    public function __construct(private readonly ChatServices $chatServices)
    {
    }

    public function index($order_id)
    {
        $messages = $this->chatServices->getMessages($order_id);
        return $this::sendSuccessResponse(ChatMessagesResource::collection($messages));
    }

    public function send(ChatMessageRequest $request, $order_id)
    {
        try {
            if (Auth::user()->is_captain) {
                $order = Order::query()->where("captain_id", Auth::id())->findOrFail($order_id);
                $sender_id = $order->captain_id;
                $receiver_id = $order->user_id;
            } else {
                $order = Order::query()->where("user_id", Auth::id())->findOrFail($order_id);
                $sender_id = $order->user_id;
                $receiver_id = $order->captain_id;
            }
            $message = $this->chatServices->sendMessage($request, $order_id, $sender_id, $receiver_id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(ChatMessagesResource::make($message));
    }

    public function show($order_id, $message_id)
    {
        return $this::sendSuccessResponse(ChatMessagesResource::make($this->chatServices->singleMessage($order_id, $message_id)));
    }

    public function makeAllReceiverMessagesRead($chat_uuid, $order_id)
    {
        $messagesMarkedAsRead = [];
        if (Auth::user()->is_captain) {
            $chat = Chat::query()->where([
                ["captain_id", Auth::id()],
                ["order_id", $order_id],
                ["uuid", $chat_uuid],
            ])->first();
        } else {
            $chat = Chat::query()->where([
                ["client_id", Auth::id()],
                ["order_id", $order_id],
                ["uuid", $chat_uuid],
            ])->first();
        }
        $messages = $chat?->messages()->where("is_seen", false)->get();
        foreach ($messages ?? [] as $message) {
            if ($message->receiver_id == Auth::id()) {
                $message->update([
                    "is_seen" => true,
                ]);
            }
            if ($message->sender_id == Auth::id()) {
                $message->update([
                    "is_seen" => true,
                ]);
            }
            $messagesMarkedAsRead[] = $message->id;
        }
        return $this::sendSuccessResponse($messagesMarkedAsRead);
    }

}
