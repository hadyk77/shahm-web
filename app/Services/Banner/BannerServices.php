<?php

namespace App\Services\Banner;

use App\Enums\BannerEnum;
use App\Http\Requests\Admin\Banner\BannerRequest;
use App\Models\Banner;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class BannerServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Banner::query()->orderBy("order", "desc")->enabled()->get();
    }

    public function findById($id): Model|Collection|Builder|array|null
    {
        return Banner::query()->orderBy("order", "desc")->enabled()->findOrFail($id);
    }

    public function findWithoutStatus($id): Model|Collection|Builder|array|null
    {
        return Banner::query()->orderBy("order", "desc")->findOrFail($id);
    }

    /**
     * @param BannerRequest $request
     * @return mixed
     * @throws Throwable
     */
    public function store($request): Banner
    {
        return DB::transaction(function () use ($request) {

            $banner = Banner::query()->create([
                "title" => $request->title,
                "order" => $request->order
            ]);

            if ($request->hasFile("image")) {

                $banner->addMedia($request->image)->toMediaCollection(BannerEnum::BannerImage);

            }
            return $banner;

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $banner = $this->findWithoutStatus($id);

            $banner->update([
                "title" => $request->title,
                "order" => $request->order
            ]);

            if ($request->hasFile("image")) {

                $banner->addMedia($request->image)->toMediaCollection(BannerEnum::BannerImage);

            }
            return $banner;

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $banner = $this->findWithoutStatus($id);

            $banner->delete();

        });
    }
}
