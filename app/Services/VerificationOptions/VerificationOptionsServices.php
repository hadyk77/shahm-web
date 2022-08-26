<?php

namespace App\Services\VerificationOptions;

use App\Enums\VerificationOptionEnum;
use App\Models\VerificationOption;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VerificationOptionsServices implements ServiceInterface
{
    public function get(): array|Collection
    {
        return VerificationOption::query()->enabled()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return VerificationOption::query()->enabled()->findOrFail($id);
        }
        return VerificationOption::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $option = VerificationOption::query()->create([
                "title" => $request->title,
                "description" => $request->description,
            ]);

            $this->handleIconUpload($request, $option);

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $option = $this->findById($id);

            $option->update([
                "title" => $request->title,
                "description" => $request->description,
            ]);

            $this->handleIconUpload($request, $option);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $option = $this->findById($id);

            $option->delete();

        });
    }

    private function handleIconUpload($request, $option)
    {
        if ($request->hasFile('icon')) {

            $option->addMedia($request->icon)->toMediaCollection(VerificationOptionEnum::ICON);

        }
    }
}
