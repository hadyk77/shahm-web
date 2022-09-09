<?php

namespace App\Services\Staff;

use App\Enums\ProfileImageEnum;
use App\Enums\RoleEnums;
use App\Enums\UserEnums;
use App\Http\Requests\Staff\StaffRequest;
use App\Models\Admin;
use App\Models\User;
use App\Services\ServiceInterface;
use App\Support\ResizeImage;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StaffServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        // TODO: Implement get() method.
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Admin::query()->where("id", "!=", 1)->findOrFail($id);
    }

    public function store($request)
    {
        return \DB::transaction(function () use ($request) {

            $staff = Admin::query()->create([
                "name" => $request->name,
                'email' => $request->email,
                "username" => $request->username,
                "password" => Hash::make($request->password),
            ]);

            $staff->assignRole($request->role);

            if ($request->hasFile("user_profile_image")) {
                $image = (new ResizeImage())
                    ->width(ProfileImageEnum::PROFILE_IMAGE_WIDTH)
                    ->height(ProfileImageEnum::PROFILE_IMAGE_HEIGHT)
                    ->upload($request->user_profile_image);
                $staff->addMedia($image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
            }

            return $staff;
        });
    }

    public function update($request, $id)
    {
        return \DB::transaction(function () use ($request, $id) {
            $staff = Admin::query()->where("id", "!=", 1)->findOrFail($id);

            tap($staff)->update([
                "name" => $request->name,
                "username" => $request->username,
                'email' => $request->email,
                "password" => $request->filled("password") ? Hash::make($request->password) : $staff->password,
            ]);

            $staff->syncRoles([$request->role]);

            if ($request->hasFile("user_profile_image")) {
                $image = (new ResizeImage())
                    ->width(ProfileImageEnum::PROFILE_IMAGE_WIDTH)
                    ->height(ProfileImageEnum::PROFILE_IMAGE_HEIGHT)
                    ->upload($request->user_profile_image);
                $staff->addMedia($image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
            }
            return $staff;
        });
    }

    public function destroy($id)
    {
        return \DB::transaction(function () use ($id) {
            $staff = $this->findById($id);
            $staff->delete();
        });
    }
}
