<?php

namespace App\Http\Controllers\API\V1\Profile;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class UpdateLocationController extends Controller
{

    public function __invoke(Request $request)
    {

        $this->validate($request, [
            "address" => "required|string",
            "address_lat" => "required|numeric|max:90|min:-90",
            "address_long" => "required|numeric|max:180|min:-180",
        ]);

        Auth::user()->update([
            "address" => $request->address,
            "address_lat" => $request->address_lat,
            "address_long" => $request->address_long,
        ]);

        return $this::sendSuccessResponse([], __("Location Updated Successfully"));

    }

}
