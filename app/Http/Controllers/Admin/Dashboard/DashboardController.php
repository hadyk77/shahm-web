<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
//        $this->middleware("auth");
    }

    public function index()
    {
        return view("admin.pages.dashboard.index");
    }

    public function updateDeviceToken(Request $request)
    {
        $this->validate($request, [
            "device_token" => "required|string"
        ]);
        Auth::user()->update([
            "device_token" => $request->device_token
        ]);
        return $this::sendSuccessResponse([], __("Device Token updated successfully"));
    }
}
