<?php

use App\Http\Controllers\API\V1\Notification\NotificationController;

Route::resource("notification", NotificationController::class)->only("index", "show", "destroy");

Route::post("notification-mark-as-read/{id}", [NotificationController::class, "markAsRead"]);

Route::post("notification-mark-all-as-read", [NotificationController::class, "markAllAsRead"]);

Route::delete("notification-delete-all", [NotificationController::class, "destroyAll"]);
