<?php

namespace App\Http\Resources\Captain;

use App\Enums\CaptainEnum;
use App\Helper\Helper;
use App\Http\Resources\VerificationOptions\VerificationOptionsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VerificationFileResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "captain_id" => $this->captain_id,
            "user_id" => $this->user_id,
            "verification_option" => VerificationOptionsResource::make($this->option),
            "file" => Helper::getFirstMediaUrl($this, CaptainEnum::VERIFICATION_FILE),
            "status" => $this->status,
            "is_read" => $this->is_read,
        ];
    }
}
