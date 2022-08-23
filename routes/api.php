<?php

use App\Http\Controllers\API\V1\Auth\CheckPhoneController;
use App\Http\Controllers\API\V1\Banner\BannerController;
use App\Http\Controllers\API\V1\Country\CountryController;
use App\Http\Controllers\API\V1\GeneralSetting\GeneralSettingController;
use App\Http\Controllers\API\V1\IntroImages\IntroImagesController;
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

    Route::get('settings', GeneralSettingController::class);

    Route::get('intro-images', IntroImagesController::class);

    Route::post("check-phone", CheckPhoneController::class);

    Route::middleware('auth:sanctum')->group(function () {



    });

});


