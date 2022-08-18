<?php

use Illuminate\Support\Facades\Route;

include "auth.php";


Route::domain("{subdomain}." . config("app.host"))->where(["subdomain", ".*"])->group(function () {

    Route::middleware(["subdomain", "statistics"])->group(function () {

        Route::get("/", function () {
            dd(request()->subdomain);
        });

    });

});


