<?php

namespace App\Services\IntroImages;

use App\Models\IntroImages;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class IntroImagesServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return IntroImages::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return IntroImages::query()->enabled()->findOrFail($id);
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
