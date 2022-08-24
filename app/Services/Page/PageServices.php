<?php

namespace App\Services\Page;

use App\Models\Page;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PageServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Page::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Page::query()->enabled()->findOrFail($id);
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
