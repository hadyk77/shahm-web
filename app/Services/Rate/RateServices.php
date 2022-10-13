<?php

namespace App\Services\Rate;

use App\Http\Resources\Rate\RateResource;
use App\Models\Captain;
use App\Models\Rate;
use App\Models\Service;
use App\Models\User;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RateServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Rate::query()->get();
    }

    public function getUserRates($type)
    {
        $rates = Rate::query()->where("user_id", Auth::id());
        if ($type == Service::class) {
            $rates = $rates->where("model_type", $type);
        }
        if ($type == User::class) {
            $rates = $rates->where("model_type", $type);
        }
        if ($type == Captain::class) {
            $rates = $rates->where("model_type", $type);
        }
        return RateResource::collection($rates->get());
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Rate::query()->findOrFail($id);
    }

    public function findUserRateById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Rate::query()->where("user_id", Auth::id())->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $model_type = Service::class;

            if ($request->model_type == "user") {
                $model_type = User::class;
            }
            if ($request->model_type == "captain") {
                $model_type = Captain::class;
            }

            return Rate::query()->create([
                "model_id" => $request->model_id,
                "model_type" => $model_type,
                "rate" => $request->rate,
                "text" => $request->text,
                "user_id" => Auth::id()
            ]);

        });
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
