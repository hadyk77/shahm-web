<?php

use App\Http\Controllers\API\V1\Order\OrderController;
use Illuminate\Support\Facades\Route;

Route::redirect("/", "/admin/login");



Route::get("download-invoice/{order}", [OrderController::class, "downloadInvoice"]);
