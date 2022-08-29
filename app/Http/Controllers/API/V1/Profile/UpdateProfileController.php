<?php

namespace App\Http\Controllers\API\V1\Profile;

use App\Enums\ProfileImageEnum;
use App\Enums\UserEnum;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Auth;
use Illuminate\Http\Request;

class UpdateProfileController extends Controller
{

    public function updateBasicInformation(Request $request)
    {
        $this->validate($request, [
            "name" => 'required',
            "phone" => 'required|unique:users,phone,' . Auth::id(),
            "email" => 'required|email|unique:users,email,' . Auth::id(),
            "date_of_birth" => 'required|date',
            "gender" => 'required|in:' . implode(",", array_keys(UserEnum::gender())),
            "profile_image" => Helper::imageRules(true),
        ]);

        Auth::user()->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "date_of_birth" => $request->date_of_birth,
            "gender" => $request->gender,
        ]);

        if ($request->hasFile("profile_image")) {

            Auth::user()->addMedia($request->profile_image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);

        }

        return $this::sendSuccessResponse(UserResource::make(Auth::user()), __("Profile Updated SSuccessfully"));
    }

    public function updateLang(Request $request)
    {
        $this->validate($request, [
            "default_lang" => "required|in:ar,en"
        ]);
        Auth::user()->update([
            "default_lang" => $request->default_lang,
        ]);
        return $this::sendSuccessResponse([], __("Lang Updated Successfully"));
    }

    public function updateNotification()
    {
        $user = Auth::user();
        Auth::user()->update([
            "enable_notification" => !$user->enable_notification,
        ]);
        return $this::sendSuccessResponse([], __("Notification Updated Successfully"));
    }

}
