<?php

use App\Http\Controllers\API\V1\Order\OrderController;
use App\Http\Controllers\API\V1\Auth\CheckPhoneController;
use App\Http\Controllers\API\V1\Auth\GetUserByTokenController;
use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\OtpController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Auth\SocialLoginController;
use App\Http\Controllers\API\V1\Banner\BannerController;
use App\Http\Controllers\API\V1\Contact\ContactController;
use App\Http\Controllers\API\V1\ContactType\ContactTypeController;
use App\Http\Controllers\API\V1\Country\CountryController;
use App\Http\Controllers\API\V1\Discount\DiscountController;
use App\Http\Controllers\API\V1\GeneralSetting\GeneralSettingController;
use App\Http\Controllers\API\V1\Governorate\GovernorateController;
use App\Http\Controllers\API\V1\IntroImages\IntroImagesController;
use App\Http\Controllers\API\V1\Page\PageController;
use App\Http\Controllers\API\V1\Nationality\NationalityController;
use App\Http\Controllers\API\V1\Profile\DeleteAccountController;
use App\Http\Controllers\API\V1\Profile\MeController;
use App\Http\Controllers\API\V1\Profile\UpdateLocationController;
use App\Http\Controllers\API\V1\Profile\UpdateProfileController;
use App\Http\Controllers\API\V1\Profile\VerifyPhoneController;
use App\Http\Controllers\API\V1\Service\ServiceController;
use App\Http\Controllers\API\V1\UpgradeOptions\UpgradeOptionsController;
use App\Http\Controllers\API\V1\VehicleType\VehicleTypeController;
use App\Http\Controllers\API\V1\VerificationOptions\VerificationOptionsController;
use Illuminate\Support\Facades\Route;

Route::prefix("api/v1")->group(function () {

    Route::apiResource("banner", BannerController::class)->only("index", "show");

    Route::apiResource("service", ServiceController::class)->only("index", "show");

    Route::apiResource("page", PageController::class)->only("index", "show");

    Route::apiResource("country", CountryController::class)->only("index", "show");

    Route::apiResource("governorate", GovernorateController::class)->only("index", "show");

    Route::apiResource("vehicle-type", VehicleTypeController::class)->only("index", "show");

    Route::apiResource("nationality", NationalityController::class)->only("index", "show");

    Route::get('settings', GeneralSettingController::class);

    Route::get('intro-images', IntroImagesController::class);

    Route::get("contact-types", ContactTypeController::class);

    Route::apiResource("account-upgrade-options", UpgradeOptionsController::class)->only("index", "show");

    Route::apiResource("verification-options", VerificationOptionsController::class)->only("index", "show");

    Route::prefix("auth")->middleware("throttle:api-auth")->group(function () {

        Route::post("check-phone", CheckPhoneController::class);

        Route::post("register", RegisterController::class);

        Route::post("login", LoginController::class);

        Route::post("social-login", SocialLoginController::class);

        Route::post("instantiate-otp", [OtpController::class, "instantiateOtp"]);

        Route::post("verify-otp", [OtpController::class, "verifyOtp"]);

        Route::post("get-user", GetUserByTokenController::class);

    });

    Route::middleware(['auth:sanctum', "api.check.status"])->group(function () {

        Route::prefix("verify")->middleware(["throttle:api-auth"])->group(function () {

            Route::post("sending-otp", [VerifyPhoneController::class, "startSendingOtp"]);

            Route::post("otp", [VerifyPhoneController::class, "verifyOtp"]);

            Route::post('update-phone', [VerifyPhoneController::class, "updatePhone"]);

        });

        Route::middleware("api.check.phone")->group(function () {

            Route::prefix("profile")->group(function () {

                Route::get("me", MeController::class);

                Route::post("update-location", UpdateLocationController::class);

                Route::post('update-profile', [UpdateProfileController::class, "updateBasicInformation"]);

                Route::post("update-lang", [UpdateProfileController::class, "updateLang"]);

                Route::post("update-notification", [UpdateProfileController::class, "updateNotification"]);

                Route::delete("delete-account", DeleteAccountController::class);

            });

            Route::apiResource("order", OrderController::class);

            Route::post("contact", ContactController::class);

            Route::get("random-valid-discount", [DiscountController::class, "randomDiscount"]);

        });


    });

});


