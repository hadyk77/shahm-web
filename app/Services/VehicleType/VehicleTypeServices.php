<?php

namespace App\Services\VehicleType;

use App\Models\Page;
use App\Models\VehicleType;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VehicleTypeServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return VehicleType::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return VehicleType::query()->enabled()->findOrFail($id);
    }

    public function store($request)
    {
        // TODO: Implement store() method.
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
