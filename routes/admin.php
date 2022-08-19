<?php

use App\Enums\GuardEnum;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Settings\BasicInformationController;
use App\Http\Controllers\Admin\Settings\DefaultImagesController;
use App\Http\Controllers\Admin\Settings\FirebaseController;
use App\Http\Controllers\Admin\Settings\SeoController;
use App\Http\Controllers\Admin\Settings\SocialMediaController;
use App\Http\Controllers\Admin\Status\StatusController;

Route::namespace("\App\Http\Controllers\Admin")->group(function () {

    Auth::routes(["verify" => true, "register" => false]);

});

Route::middleware("auth:" . GuardEnum::ADMIN)->group(function () {

    Route::get("/", [DashboardController::class, "index"]);

    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard.index");



    Route::resource("banner", BannerController::class)->except("show");


    Route::post("update-status", StatusController::class)->name("status.update");

    Route::prefix("settings")->name("settings.")->group(function () {

        Route::resource("basic-information", BasicInformationController::class)->only("index", "store");

        Route::resource("social-media", SocialMediaController::class)->only("index", "store");

        Route::resource("firebase", FirebaseController::class)->only("index", "store");

        Route::resource("default-images", DefaultImagesController::class)->only("index", "store");

        Route::resource("seo", SeoController::class)->only("index", "store");

        Route::resource("seo", SeoController::class)->only("index", "store");

    });

    Route::prefix("profile")->name("profile.")->group(function () {

        Route::get("/", [ProfileController::class, "index"])->name("index");

        Route::post("/", [ProfileController::class, "update"])->name("update");

        Route::post("update-password", [ProfileController::class, "updatePassword"])->name("update.password");

    });
});
