<?php

Route::namespace("\App\Http\Controllers\User")->group(function () {

    Auth::routes(["verify" => false, "register" => true]);

});
