<?php

namespace App\Http\Controllers\API\V1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notification\NotificationResource;
use App\Services\Nationality\NationalityService;
use App\Services\Notification\NotificationServices;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationController extends Controller
{
    public function __construct(private readonly NotificationServices $notificationServices)
    {
    }

    public function index()
    {
        $notifications = $this->notificationServices->getNotificationForClients();
        return $this::sendSuccessResponse(NotificationResource::collection($notifications));
    }

    public function show($id)
    {
        $notification = $this->notificationServices->findNotificationForClientById($id);
        return $this::sendSuccessResponse(NotificationResource::make($notification));
    }

    public function markAsRead($id)
    {
        $notification = $this->notificationServices->findNotificationForClientById($id);
        try {
            $notification->markAsRead();
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Marked As Read"));
    }

    public function markAllAsRead()
    {
        $notifications = $this->notificationServices->getNotificationForClients();
        try {
            foreach ($notifications as $notification) {
                $notification->markAsRead();
            }
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("All Marked As Read"));
    }

    public function destroy($id)
    {
        $notification = $this->notificationServices->findNotificationForClientById($id);
        try {
            $this->notificationServices->destroy($notification->id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Deleted Successfully"));
    }

    public function destroyAll()
    {
        $notifications = $this->notificationServices->getNotificationForClients();
        try {
            foreach ($notifications as $notification) {
                $notification->delete();
            }
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("All Deleted Successfully"));
    }

}
