<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Chat\ChatMessageRequest;
use App\Http\Resources\Chat\ChatMessagesResource;
use App\Models\Chat;
use App\Models\Order;
use App\Services\Chat\ChatServices;
use Auth;
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
            $order = Order::query()->where("user_id", Auth::id())->findOrFail($order_id);
            $sender_id = Auth::id();
            $receiver_id = $order->captain_id;
            $this->chatServices->sendMessage($request, $order_id, $sender_id, $receiver_id);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse();
    }

    public function show($order_id, $message_id)
    {
        return $this::sendSuccessResponse(ChatMessagesResource::make($this->chatServices->singleMessage($order_id, $message_id)));
    }
}
