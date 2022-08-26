<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class BasicInformationController extends Controller
{
    public function index()
    {
        $gs = GeneralSetting::query()->first();
        return view('admin.pages.settings.basic-information')->with([
            "gs" => $gs,
        ]);
    }

    public function store(Request $request)
    {


        return back()->with('success', __('Updated Successfully'));
    }
}
