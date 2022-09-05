<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Enums\AdminEnum;
use App\Enums\GuardEnum;
use App\Enums\ProfileImageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\ProfileRequest;
use App\Http\Requests\Admin\Profile\UpdatePasswordRequest;
use App\Support\ResizeImage;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.pages.profile.index');
    }

    public function update(ProfileRequest $request)
    {

        $admin = Auth::guard(GuardEnum::ADMIN)->user();

        $admin->update([
            "name" => $request->name,
            "email" => $request->email,
            "username" => $request->username,
        ]);

        if ($request->hasFile("avatar")) {

            $image = ResizeImage::make()
                ->enableAspectRatio()
                ->width(ProfileImageEnum::PROFILE_IMAGE_WIDTH)
                ->height(ProfileImageEnum::PROFILE_IMAGE_HEIGHT)
                ->upload($request->avatar);

            $admin->addMedia($image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);

        }

        return back()->with("success", __("Profile Updated Successfully"));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {

        Auth::guard(GuardEnum::ADMIN)->user()->update([
            "password" => Hash::make($request->password),
        ]);

        return back()->with("success", __("Password Updated Successfully"));
    }
}
