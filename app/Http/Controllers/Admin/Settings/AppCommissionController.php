<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class AppCommissionController extends Controller
{
    public function index()
    {
        $gs = GeneralSetting::query()->first();
        return view('admin.pages.settings.app-commission')->with([
            "gs" => $gs,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            "client_commission"  => "required|numeric",
            "captain_commission"  => "required|numeric",
        ]);

        $gs = GeneralSetting::query()->first();

        $gs->update([
            "client_commission" => $request->client_commission,
            "captain_commission" => $request->captain_commission,
        ]);

        return back()->with('success', __('Updated Successfully'));
    }
}
