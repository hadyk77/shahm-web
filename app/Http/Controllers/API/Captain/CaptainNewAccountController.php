<?php

namespace App\Http\Controllers\API\Captain;

use App\Http\Controllers\Controller;
use App\Services\Otp\OtpServices;
use Auth;
use Illuminate\Http\Request;

class CaptainNewAccountController extends Controller
{

    public function __construct(private readonly OtpServices $otpServices)
    {
    }

    public function addPhone(Request $request)
    {

        $this->validate($request, [
            "captain_phone_number" => "required|string|unique:users,captain_phone_number," . Auth::id()
        ]);

        $user = Auth::user();

        $user->update([
            "captain_phone_number" => $request->captain_phone_number,
            "is_captain_phone_number_verified" => false,
        ]);

        return $this->otpServices->instantiateOtp($request, "captain_phone_number");
    }

    public function verifyOtp(Request $request)
    {
        return $this->otpServices->verifyOtp($request, "captain_phone_number", is_captain: true);
    }
}
