<?php

namespace App\Services\Staff;

use App\Enums\RoleEnums;
use App\Enums\UserEnums;
use App\Http\Requests\Staff\StaffRequest;
use App\Models\User;
use App\Support\ResizeImage;
use Hash;

class StaffServices
{
    public static function store(StaffRequest $request): User
    {
        $user = User::query()->create([
            "name" => $request->name,
            'email' => $request->email,
            "username" => $request->username,
            "password" => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        if ($request->hasFile("user_profile_image")) {
            $image = (new ResizeImage())
                ->width(UserEnums::USER_PROFILE_IMAGE_WIDTH)
                ->height(UserEnums::USER_PROFILE_IMAGE_HEIGHT)
                ->upload($request->user_profile_image);
            $user->addMedia($image)->toMediaCollection(UserEnums::USER_PROFILE_IMAGE);
        }
        return $user;
    }

    public static function update(StaffRequest $request, int $id): User
    {
        $user = User::query()->where("id", "!=", 1)->findOrFail($id);

        tap($user)->update([
            "name" => $request->name,
            "username" => $request->username,
            'email' => $request->email,
            "password" => $request->filled("password") ? Hash::make($request->password) : $user->password,
        ]);
        $user->syncRoles([$request->role]);
        if ($request->hasFile("user_profile_image")) {
            $image = (new ResizeImage())
                ->width(UserEnums::USER_PROFILE_IMAGE_WIDTH)
                ->height(UserEnums::USER_PROFILE_IMAGE_HEIGHT)
                ->upload($request->user_profile_image);
            $user->addMedia($image)->toMediaCollection(UserEnums::USER_PROFILE_IMAGE);
        }
        return $user;
    }

}
