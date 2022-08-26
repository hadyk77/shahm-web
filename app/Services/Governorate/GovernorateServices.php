<?php

namespace App\Services\Governorate;

use App\Enums\BannerEnum;
use App\Http\Requests\Admin\Banner\BannerRequest;
use App\Models\Banner;
use App\Models\Governorate;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class GovernorateServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Governorate::query()->enabled()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return Governorate::query()->enabled()->findOrFail($id);
        }
        return Governorate::query()->findOrFail($id);
    }

    public function store($request): Governorate
    {
        return DB::transaction(function () use ($request) {

            return Governorate::query()->create([
                "title" => $request->title
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $governorate = $this->findById($id);

            $governorate->update([
                "title" => $request->title,
            ]);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $governorate = $this->findById($id);

            $governorate->delete();

        });
    }
}
