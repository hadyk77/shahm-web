<?php

namespace App\Services\BaseService;

use App\Models\Service;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseServices implements ServiceInterface
{
    public function get(): array|Collection
    {
        return Service::query()->get();
    }

    public function findById($id): Model|Collection|Builder|array|null
    {
        return Service::query()->enabled()->findOrFail($id);
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