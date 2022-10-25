<?php

namespace App\Http\Resources\Chat;

use App\Enums\ChatEnum;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatMessagesResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "sender" => [
                "id" => $this->sender->id,
                "name" => $this->sender->name,
                "image" => $this->sender->profile_image,
                "phone" => $this->sender->phone,
            ],
            "receiver" => [
                "id" => $this->receiver->id,
                "name" => $this->receiver->name,
                "image" => $this->receiver->profile_image,
                "phone" => $this->receiver->phone,
            ],
            "message_text" => $this->message_text,
            "type" => $this->type,
            "location" => [
                "lat" => $this->lat,
                "long" => $this->long,
            ],
            "links" => $this->links,
            "images" => Helper::getModelMultiMediaUrls($this, ChatEnum::CHAT_IMAGES),
            "audios" => Helper::getModelMultiMediaUrls($this, ChatEnum::CHAT_AUDIOS),
            "is_seen" => $this->is_seen,
            "created_at" => Helper::formatDate($this->created_at),
        ];
    }
}
