<?php

namespace App\Services\ExpectedPriceRange;

use App\Models\ExpectedPriceRange;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ExpectedPriceRangeServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return ExpectedPriceRange::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return ExpectedPriceRange::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return ExpectedPriceRange::query()->create([
                "kilometer_from" => $request->kilometer_from,
                "kilometer_to" => $request->kilometer_to,
                "price_from" => $request->price_from,
                "price_to" => $request->price_to,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $expectedPriceRange = $this->findById($id);

            $expectedPriceRange->update([
                "kilometer_from" => $request->kilometer_from,
                "kilometer_to" => $request->kilometer_to,
                "price_from" => $request->price_from,
                "price_to" => $request->price_to,
            ]);

            return $expectedPriceRange;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $expectedPriceRange = $this->findById($id);

            $expectedPriceRange->delete();

        });
    }
}
