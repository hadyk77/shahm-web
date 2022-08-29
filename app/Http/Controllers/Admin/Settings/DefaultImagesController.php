<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Enums\GeneralSettingEnum;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class DefaultImagesController extends Controller
{
    public function index()
    {
        $gs = GeneralSetting::query()->first();
        return view('admin.pages.settings.default-images')->with([
            "gs" => $gs,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            "profile_image" => Helper::imageRules(true)
        ]);

        $gs = GeneralSetting::query()->first();

        if ($request->hasFile("profile_image")) {
            $gs->addMedia($request->profile_image)->toMediaCollection(GeneralSettingEnum::DEFAULT_PROFILE_IMAGE);
        }

        return back()->with('success', __('Updated Successfully'));
    }
}
