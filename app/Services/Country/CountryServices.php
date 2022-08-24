<?php

namespace App\Services\Country;

use App\Enums\CountryEnum;
use App\Models\Country;
use App\Models\Page;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CountryServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Country::query()->get();
    }

    public function findById($id, $status = true): Model|Collection|Builder|array|null
    {
        if ($status) {
            return Country::query()->enabled()->findOrFail($id);
        }
        return Country::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $country = Country::query()->create([
                "title" => $request->title,
                "country_code" => $request->country_code
            ]);

            $this->handleFlagUpload($request, $country);

            return $country;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $country = $this->findById($id, false);

            $country->update([
                "title" => $request->title,
                "country_code" => $request->country_code
            ]);

            $this->handleFlagUpload($request, $country);

            return $country;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $country = $this->findById($id, false);

            $country->delete();
        });
    }

    private function handleFlagUpload($request, $country)
    {
        if ($request->hasFile('flag')) {
            $country->addMedia($request->flag)->toMediaCollection(CountryEnum::FLAG);
        }
    }
}
