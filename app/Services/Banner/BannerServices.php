<?php

namespace App\Services\Banner;

use App\Models\Banner;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BannerServices implements ServiceInterface
{

    public function get()
    {
        return Banner::query()->orderBy("order", "desc")->enabled()->get();
    }

    public function findById($id): Model|Collection|Builder|array|null
    {
        return Banner::query()->orderBy("order", "desc")->enabled()->findOrFail($id);
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
