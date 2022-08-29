<?php

namespace App\Services\Contact;

use App\Models\ContactType;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ContactTypeService implements ServiceInterface
{
    public function get(): array|Collection
    {
        return ContactType::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return ContactType::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            return ContactType::query()->create([
                "title" => $request->title,
            ]);

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $contactType = $this->findById($id);

            $contactType->update([
                "title" => $request->title,
            ]);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $contactType = $this->findById($id);

            $contactType->delete();

        });
    }
}
