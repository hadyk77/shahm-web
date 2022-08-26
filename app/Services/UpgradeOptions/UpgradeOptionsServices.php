<?php

namespace App\Services\UpgradeOptions;

use App\Models\AccountUpgradeOption;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UpgradeOptionsServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return AccountUpgradeOption::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return AccountUpgradeOption::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return AccountUpgradeOption::query()->create([
                'title' => $request->title,
                "completed_orders_count" => $request->completed_orders_count,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $option = $this->findById($id);
            $option->update([
                'title' => $request->title,
                "completed_orders_count" => $request->completed_orders_count,
            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $option = $this->findById($id);

            $option->delete();

        });
    }
}
