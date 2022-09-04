<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->unreadNotifications()->latest()->take(20)->get();
        return view("global-partials.notifications")->with([
            "notifications" => $notifications
        ]);
    }

    public function update(Request $request, $id)
    {
        Auth::user()->notifications()->where("id", $id)->first()->markAsRead();
        return $this::sendSuccessResponse([
            "remaining_notification" => Auth::user()->unreadNotifications()->count(),
        ]);
    }
}
