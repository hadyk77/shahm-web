<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class CheckPhoneController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validatePhone($request);

        return $this::sendSuccessResponse([
            "phone_exists" => $this->isPhoneExists($request)
        ]);

    }

    private function isPhoneExists(Request $request)
    {
        return DB::table("users")->where("phone", $request->phone)->exists();
    }

    private function validatePhone(Request $request)
    {
        $this->validate($request, [
            "phone" => "required"
        ]);
    }

}
