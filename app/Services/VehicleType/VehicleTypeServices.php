<?php

namespace App\Services\VehicleType;

use App\Models\Page;
use App\Models\VehicleType;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VehicleTypeServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return VehicleType::query()->enabled()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return VehicleType::query()->enabled()->findOrFail($id);
        }
        return VehicleType::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            return VehicleType::query()->create([
                "title" => $request->title,
            ]);

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $vehicleType = $this->findById($id);

            $vehicleType->update([
                "title" => $request->title
            ]);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $vehicleType = $this->findById($id);

            $vehicleType->delete();

        });
    }
}
