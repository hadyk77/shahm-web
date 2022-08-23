<?php

use App\Http\Controllers\API\V1\Banner\BannerController;
use App\Http\Controllers\API\V1\Country\CountryController;
use App\Http\Controllers\API\V1\Page\PageController;
use App\Http\Controllers\API\V1\Service\ServiceController;
use App\Http\Controllers\API\V1\VehicleType\VehicleTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix("api/v1")->group(function () {

    Route::apiResource("banner", BannerController::class)->only("index", "show");

    Route::apiResource("service", ServiceController::class)->only("index", "show");

    Route::apiResource("page", PageController::class)->only("index", "show");

    Route::apiResource("country", CountryController::class)->only("index", "show");

    Route::apiResource("vehicle-type", VehicleTypeController::class)->only("index", "show");

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

});


