<?php

namespace App\Http\Resources\ContactType;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactTypeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
        ];
    }
}
