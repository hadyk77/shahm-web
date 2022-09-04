<?php

namespace App\Services\Captain;

use App\Enums\CaptainEnum;
use App\Models\Captain;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CaptainServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Captain::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return Captain::query()->where("status", 1)->findOrFail($id);
        }
        return Captain::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $captain = Captain::query()->create([
                "user_id" => $request->user_id,
                "vehicle_type_id" => $request->vehicle_type_id,
                "vehicle_manufacturing_date" => $request->vehicle_manufacturing_date,
                "vehicle_number" => $request->vehicle_number,
                "vehicle_identification_number" => $request->vehicle_identification_number,
                "vehicle_license_plate_number" => $request->vehicle_license_plate_number,
            ]);

            $captain->user->update([
                "is_captain" => true,
            ]);

            if ($request->hasFile('license_from_front')) {
                $captain->addMedia($request->license_from_front)->toMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_FRONT);
            }

            if ($request->hasFile('license_from_back')) {
                $captain->addMedia($request->license_from_back)->toMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_FRONT);
            }

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $captain = $this->findById($id);

            $captain->update([
                "vehicle_type_id" => $request->vehicle_type_id,
                "vehicle_manufacturing_date" => $request->vehicle_manufacturing_date,
                "vehicle_number" => $request->vehicle_number,
                "vehicle_identification_number" => $request->vehicle_identification_number,
                "vehicle_license_plate_number" => $request->vehicle_license_plate_number,
            ]);

            if ($request->hasFile('license_from_front')) {
                $captain->addMedia($request->license_from_front)->toMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_FRONT);
            }

            if ($request->hasFile('license_from_back')) {
                $captain->addMedia($request->license_from_back)->toMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_FRONT);
            }
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $captain = $this->findById($id);

            $captain->user->update([
                "is_captain" => false,
            ]);

            $captain->delete();

        });
    }
}
