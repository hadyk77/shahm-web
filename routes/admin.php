<?php

use App\Enums\GuardEnum;
use App\Http\Controllers\Admin\Banner\BannerController;
use App\Http\Controllers\Admin\Captain\CaptainController;
use App\Http\Controllers\Admin\Captain\VerificationFilesController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\Contact\ContactTypeController;
use App\Http\Controllers\Admin\Country\CountryController;
use App\Http\Controllers\Admin\Coupon\DiscountController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Governorate\GovernorateController;
use App\Http\Controllers\Admin\IntroImage\IntroImageController;
use App\Http\Controllers\Admin\Nationality\NationalityController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use App\Http\Controllers\Admin\Page\PageController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Service\ServiceController;
use App\Http\Controllers\Admin\Service\ServiceRateController;
use App\Http\Controllers\Admin\Settings\AppCommissionController;
use App\Http\Controllers\Admin\Settings\BasicInformationController;
use App\Http\Controllers\Admin\Settings\DefaultImagesController;
use App\Http\Controllers\Admin\Settings\FirebaseController;
use App\Http\Controllers\Admin\Settings\PaymentsController;
use App\Http\Controllers\Admin\Settings\SocialMediaController;
use App\Http\Controllers\Admin\Status\StatusController;
use App\Http\Controllers\Admin\Translation\TranslationController;
use App\Http\Controllers\Admin\UpgradeOptions\UpgradeOptionsController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\VehicleType\VehicleTypeController;
use App\Http\Controllers\Admin\VerificationOptions\VerificationOptionsController;

Route::namespace("\App\Http\Controllers\Admin")->group(function () {

    Auth::routes(["verify" => true, "register" => false]);

});

Route::middleware("auth:" . GuardEnum::ADMIN)->group(function () {

    Route::get("/", [DashboardController::class, "index"]);

    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard.index");

    Route::resource('service', ServiceController::class)->except("destroy", "create", "store");

    Route::resource("contact-type", ContactTypeController::class)->except("show");

    Route::resource("contact", ContactController::class)->only("show", "index", "destroy");

    Route::resource("discount", DiscountController::class)->except('show');

    Route::resource("verification-options", VerificationOptionsController::class)->except("show");

    Route::resource("upgrade-options", UpgradeOptionsController::class)->except("show");

    Route::resource("banner", BannerController::class)->except("show");

    Route::resource("country", CountryController::class)->except('show');

    Route::resource("governorate", GovernorateController::class);

    Route::resource("page", PageController::class)->except('show');

    Route::resource("vehicle-type", VehicleTypeController::class)->except('show');

    Route::resource("intro-image", IntroImageController::class)->except('show');

    Route::resource("nationality", NationalityController::class)->except('show');

    Route::resource("user", UserController::class);

    Route::resource("captain", CaptainController::class);

    Route::resource("verification-files", VerificationFilesController::class)->only("index", "show", "store");

    Route::get("notifications", [NotificationController::class, "index"])->name("notification.index");

    Route::post("update-status", StatusController::class)->name("status.update");

    Route::prefix("settings")->name("settings.")->group(function () {

        Route::resource("basic-information", BasicInformationController::class)->only("index", "store");

        Route::resource("app-commission", AppCommissionController::class)->only("index", "store");

        Route::resource("payment-options", PaymentsController::class)->only("index", "store");

        Route::resource("social-media", SocialMediaController::class)->only("index", "store");

        Route::get("int-firebase", [FirebaseController::class, "init"])->name("init.firebase");

        Route::resource("firebase", FirebaseController::class)->only("index", "store");

        Route::resource("default-images", DefaultImagesController::class)->only("index", "store");

    });

    Route::get("translation", [TranslationController::class, "index"])->name("translation.index");

    Route::post("get-translations-columns", [TranslationController::class, "show"])->name("translation.show");

    Route::post("translation", [TranslationController::class, "update"])->name("translation.update");

    Route::prefix("profile")->name("profile.")->group(function () {

        Route::get("/", [ProfileController::class, "index"])->name("index");

        Route::post("/", [ProfileController::class, "update"])->name("update");

        Route::post("update-password", [ProfileController::class, "updatePassword"])->name("update.password");

    });

    Route::put("update-device-token", [DashboardController::class, "updateDeviceToken"])->name("update-device-token");
});
