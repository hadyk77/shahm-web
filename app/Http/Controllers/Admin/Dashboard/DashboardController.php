<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
//        $this->middleware("auth");
    }

    public function index()
    {
        return view("admin.pages.dashboard.index")->with([
            "orderCount" => DB::table("orders")->count(),
            "clientCount" => DB::table("users")->where('is_captain', false)->count(),
            "captainCount" => DB::table("users")->where('is_captain', true)->count(),
            "bannerCount" => DB::table("banners")->count(),
            "contactCount" => DB::table("contacts")->count(),
            "couponsCount" => DB::table("discounts")->count(),
            "captainVerifications" => DB::table("captain_verification_files")->count(),
            "verificationOptions" => DB::table("verification_options")->count(),
        ]);
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

    public function orderChart(): JsonResponse
    {
        for ($i = 1; $i < 12; $i++) {
            $year = now()->format("Y");
            $date_1 = Carbon::create($year, $i)->startOfMonth()->format('Y-m-d');
            $date_2 = Carbon::create($year, $i)->lastOfMonth()->format('Y-m-d');
            $order_counts[] = DB::table("orders")
                ->whereDate("created_at", ">=", $date_1)
                ->whereDate("created_at", "<=", $date_2)
                ->count();
        }
        return $this::sendSuccessResponse([
            "counts" => $order_counts,
            "months" => collect(Helper::months())->values()->pluck("title")->values()
        ], __("Data Retrieved Successfully"));
    }

    public function captainChart(): JsonResponse
    {
        for ($i = 1; $i < 12; $i++) {
            $year = now()->format("Y");
            $date_1 = Carbon::create($year, $i)->startOfMonth()->format('Y-m-d');
            $date_2 = Carbon::create($year, $i)->lastOfMonth()->format('Y-m-d');
            $order_counts[] = DB::table("captains")
                ->whereDate("created_at", ">=", $date_1)
                ->whereDate("created_at", "<=", $date_2)
                ->count();
        }
        return $this::sendSuccessResponse([
            "counts" => $order_counts,
            "months" => collect(Helper::months())->values()->pluck("title")->values()
        ], __("Data Retrieved Successfully"));
    }
}
