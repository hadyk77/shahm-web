<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralSettings\BasicInformationRequest;
use App\Models\GeneralSetting;
use Artisan;
use Exception;
use Illuminate\Http\Request;
use Log;

class BasicInformationController extends Controller
{
    public function index()
    {
        $gs = GeneralSetting::query()->first();
        return view('admin.pages.settings.basic-information')->with([
            "gs" => $gs,
        ]);
    }

    public function store(BasicInformationRequest $request)
    {
        $gs = GeneralSetting::query()->first();

        $gs->update([
            "title" => $request->title,
            "description" => $request->description,
            "first_email" => $request->first_email,
            "second_email" => $request->second_email,
            "first_phone" => $request->first_phone,
            "second_phone" => $request->second_phone,
            "maximum_indebtedness_for_captain" => $request->maximum_indebtedness_for_captain,
            "service_price_per_kilometer" => $request->service_price_per_kilometer,
            "tax" => $request->tax,
            "max_radius" => $request->max_radius,
        ]);

        try {
            Artisan::call("remove");
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return back()->with('success', __('Updated Successfully'));
    }
}
