<?php

namespace App\Services\Country;

use App\Models\Country;
use App\Models\Page;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CountryServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Country::query()->get();
    }

    public function findById($id): Model|Collection|Builder|array|null
    {
        return Country::query()->enabled()->findOrFail($id);
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
