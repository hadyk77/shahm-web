<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Artisan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FirebaseController extends Controller
{
    public function index()
    {
        $gs = GeneralSetting::query()->first();
        return view('admin.pages.settings.firebase')->with([
            "gs" => $gs,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            "fcm_key" => "required|string",
            "firebase_api_key" => "required|string",
            "firebase_auth_domain" => "required|string",
            "firebase_database_url" => "required|string",
            "firebase_project_id" => "required|string",
            "firebase_storage_bucket" => "required|string",
            "firebase_messaging_sender_id" => "required|string",
            "firebase_app_id" => "required|string",
        ]);

        $gs = GeneralSetting::query()->first();

        $gs->update([
            "fcm_key" => $request->fcm_key,
            "firebase_api_key" => $request->firebase_api_key,
            "firebase_auth_domain" => $request->firebase_auth_domain,
            "firebase_database_url" => $request->firebase_database_url,
            "firebase_project_id" => $request->firebase_project_id,
            "firebase_storage_bucket" => $request->firebase_storage_bucket,
            "firebase_messaging_sender_id" => $request->firebase_messaging_sender_id,
            "firebase_app_id" => $request->firebase_app_id,
        ]);

        try {

            Artisan::call("remove");

        } catch (Exception $exception) {

            Log::error($exception->getMessage());

        }

        return back()->with('success', __('Updated Successfully'));
    }

    public function init()
    {
        return response()->view("firebase.sw_firebase")->header("Content-Type", "application/javascript");
    }

}
