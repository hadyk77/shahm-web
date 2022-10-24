<?php

namespace App\Services\CancelReason;

use App\Models\CancelReason;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CancelReasonServices implements ServiceInterface
{
    public function get(): Collection
    {
        return CancelReason::query()->enabled()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return CancelReason::query()->enabled()->findOrFail($id);
        }
        return CancelReason::query()->findOrFail($id);
    }

    public function store($request): CancelReason
    {
        return DB::transaction(function () use ($request) {
            return CancelReason::query()->create([
                "title" => $request->title
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $cancelReason = $this->findById($id);

            $cancelReason->update([
                "title" => $request->title,
            ]);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $cancelReason = $this->findById($id);

            $cancelReason->delete();

        });
    }
}
