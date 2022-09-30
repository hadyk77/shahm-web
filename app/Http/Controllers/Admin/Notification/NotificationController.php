<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Enums\NotificationEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->latest()->take(50)->get();
        return view("global-partials.notifications")->with([
            "notifications" => $notifications
        ]);
    }

    public function update(Request $request, $id)
    {
        $notification = Auth::user()->notifications()->where("id", $id)->first();

        $notification->markAsRead();

        return $this::sendSuccessResponse([
            "redirect_url" => self::notificationRedirectUrl($notification),
            "remaining_notification" => Auth::user()->unreadNotifications()->count(),
        ]);
    }

    private static function notificationRedirectUrl($notification): string|null
    {
        $redirect_url = null;
        if ($notification->data['type'] == NotificationEnum::NEW_ORDER_REQUEST) {
            $redirect_url = route("admin.order.show", $notification->data["order"]['id']);
        }
        if ($notification->data['type'] == NotificationEnum::NEW_USER_REGISTER) {
            $redirect_url = route("admin.user.show", [$notification->data["user"]['id'], 'type' => "overview"]);
        }
        if ($notification->data['type'] == NotificationEnum::NEW_CONTACT_MESSAGE) {
            $redirect_url = route("admin.contact.show", $notification->data["contact"]['id']);
        }
        return $redirect_url;
    }

}
