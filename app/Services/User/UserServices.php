<?php

namespace App\Services\User;

use App\Enums\ProfileImageEnum;
use App\Models\User;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return User::query()->where("status", 1)->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return User::query()->where("status", 1)->findOrFail($id);
        }
        return User::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $user = User::query()->create([
                "name" => $request->name,
                "phone" => $request->phone,
                "email" => $request->email,
                "date_of_birth" => $request->date_of_birth,
                "gender" => $request->gender,
            ]);

            if ($request->hasFile("profile_image")) {
                $user->addMedia($request->profile_image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
            }

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $user = $this->findById($id);

            $user->update([
                "name" => $request->name,
                "phone" => $request->phone,
                "email" => $request->email,
                "date_of_birth" => $request->date_of_birth,
                "gender" => $request->gender,
            ]);

            if ($request->hasFile("profile_image")) {
                $user->addMedia($request->profile_image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
            }
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $user = $this->findById($id);

            $user->delete();

        });
    }
}
