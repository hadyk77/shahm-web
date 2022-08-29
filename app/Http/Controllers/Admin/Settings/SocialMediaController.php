<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SocialMediaController extends Controller
{
    public function index()
    {
        $gs = GeneralSetting::query()->first();
        return view('admin.pages.settings.social-media-links')->with([
            "gs" => $gs,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'facebook_link' => "required|url",
            'twitter_link' => "required|url",
            'instagram_link' => "required|url",
            'linkedin_link' => "required|url",
            'snapchat_link' => "required|url",
            'tiktok_link' => "required|url",
        ]);

        $gs = GeneralSetting::query()->first();

        $gs->update([
            "facebook_link" => $request->facebook_link,
            "twitter_link" => $request->twitter_link,
            "instagram_link" => $request->instagram_link,
            "linkedin_link" => $request->linkedin_link,
            "snapchat_link" => $request->snapchat_link,
            "tiktok_link" => $request->tiktok_link,
        ]);


        try {
            Artisan::call("remove");
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }

        return back()->with('success', __('Updated Successfully'));
    }
}
