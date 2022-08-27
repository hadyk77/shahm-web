<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index()
    {
        $gs = GeneralSetting::query()->first();
        return view('admin.pages.settings.payment-details')->with([
            "gs" => $gs,
        ]);
    }

    public function store(Request $request)
    {

        $gs = GeneralSetting::query()->first();
        $gs->update([
            "is_credit_card_enabled" => $request->is_credit_card_enabled == "1",
            "is_wallet_enabled" => $request->is_wallet_enabled == "1",
            "is_cash_enabled" => $request->is_cash_enabled == "1",
        ]);
        return back()->with('success', __('Updated Successfully'));
    }
}
