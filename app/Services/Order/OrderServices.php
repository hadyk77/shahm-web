<?php

namespace App\Services\Order;

use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OrderServices implements ServiceInterface
{
    public function get(): array|Collection
    {
        // TODO: Implement get() method.
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        // TODO: Implement findById() method.
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
