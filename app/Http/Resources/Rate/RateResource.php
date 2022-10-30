<?php

namespace App\Http\Resources\Rate;

use App\Helper\Helper;
use App\Models\Captain;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class RateResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $ratable = [];

        if ($this->model_type == Service::class) {
            $service = Service::query()->find($this->model_id);
            $ratable = [
                "id" => $service->id,
                "title" => $service->title,
                "image" => $service->icon
            ];
        }
        if ($this->model_type == User::class || $this->model_type == Captain::class) {
            $user = User::query()->find($this->model_id);
            $ratable = [
                "id" => $user->id,
                "name" => $user->name,
                "profile_image" => $user->profile_image,
            ];
        }
        return [
            "id" => $this->id,
            "rate_for" => strtolower(Str::remove("App\\Models\\",  $this->model_type)),
            "ratable_type" => $ratable,
            "rate" => $this->rate,
            "text" => $this->text,
            "created_at" => Helper::formatDate($this->created_at)
        ];
    }
}
