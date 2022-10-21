<?php

use App\Http\Controllers\API\V1\Captain\BetweenGovernorateServiceController;
use App\Http\Controllers\API\V1\Captain\CaptainNewAccountController;
use App\Http\Controllers\API\V1\Captain\CaptainOfferController;
use App\Http\Controllers\API\V1\Captain\CaptainOrderController;
use App\Http\Controllers\API\V1\Captain\CaptainSettingController;
use App\Http\Controllers\API\V1\Captain\VerificationFileController;
use App\Http\Controllers\API\V1\Profile\MeController;
use App\Http\Controllers\API\V1\Rate\RateController;

Route::prefix("captain")->middleware("throttle:api-auth")->group(function () {

    Route::post("add-phone", [CaptainNewAccountController::class, "addPhone"]);

    Route::post("verify-otp", [CaptainNewAccountController::class, "verifyOtp"]);

    Route::post("open-new-account", [CaptainNewAccountController::class, "openNewAccount"]);

});

Route::prefix("captain")->middleware("api.check.captain.phone")->group(function () {

    Route::get("me", MeController::class);

    Route::apiResource("between-governorate-service", BetweenGovernorateServiceController::class);

    Route::post("toggle-orders", [CaptainSettingController::class, 'toggleOrders']);

    Route::apiResource("offer", CaptainOfferController::class);

    Route::get("get-offer-by-order/{id}", [CaptainOfferController::class, "getOfferByOrder"]);

    Route::post("send-offer/{id}", [CaptainOfferController::class, "sendOffer"]);

    Route::post('my-order', [CaptainOrderController::class, "myOrder"]);

    Route::get('new-order', [CaptainOrderController::class, "newOrder"]);

    Route::get('order/{id}', [CaptainOrderController::class, "show"]);

    Route::post('update-order-details/{id}', [CaptainOrderController::class, "updateOrderDetails"]);

    Route::post('update-order-status/{id}', [CaptainOrderController::class, "updateOrderStatus"]);

    Route::get("upgrade-options", [CaptainSettingController::class, "upgradeOption"]);

    Route::apiResource("rate", RateController::class)->only("index", "store", "show");

    Route::apiResource("verification-files", VerificationFileController::class)->only("index", "store");

});
