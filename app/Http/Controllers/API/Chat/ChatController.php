<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatMessagesResource;
use App\Models\Chat;
use App\Services\Chat\ChatServices;
use Auth;

class ChatController extends Controller
{

    public function __construct(private readonly ChatServices $chatServices)
    {
    }

    public function index($order_id)
    {

        return $this::sendSuccessResponse(ChatMessagesResource::collection($messages));
    }

    public function send()
    {

    }
}
