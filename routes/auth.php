<?php

use App\Http\Controllers\API\V1\Auth\LoginController;

Route::namespace("\App\Http\Controllers\API\V1")->group(function () {

    Route::post("login", [LoginController::class, "login"]);

    Route::post("register", [LoginController::class, "register"]);

});
