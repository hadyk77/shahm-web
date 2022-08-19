<?php

use App\Http\Controllers\API\V1\Banner\BannerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix("api/v1")->group(function () {

    Route::apiResource("banner", BannerController::class)->only("index", "show");

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

});


