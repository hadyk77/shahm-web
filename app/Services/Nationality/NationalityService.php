<?php

namespace App\Services\Nationality;

use App\Models\Nationality;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NationalityService implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Nationality::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return Nationality::query()->enabled()->findOrFail($id);
        }
        return Nationality::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return Nationality::query()->create([
                "title" => $request->title,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $nationality = $this->findById($id);

            $nationality->update([
                "title" => $request->title,
            ]);

            return $nationality;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $nationality = $this->findById($id);

            $nationality->delete();
        });
    }
}
