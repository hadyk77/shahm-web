<?php

namespace App\Http\Controllers\API\V1\Profile;

use App\Http\Controllers\Controller;
use App\Services\Otp\OtpServices;
use Auth;
use Illuminate\Http\Request;

class VerifyPhoneController extends Controller
{
    public function __construct(private readonly OtpServices $otpServices)
    {
    }

    public function startSendingOtp()
    {
        $this->checkUserPhone();

        $request = request();

        $request = $request->merge([
            "phone" => Auth::user()->phone,
        ]);

        return $this->otpServices->instantiateOtp($request);
    }

    public function verifyOtp(Request $request)
    {
        $this->checkUserPhone();

        $this->validate($request, [
            "otp_key" => 'required|string'
        ]);

        $request = $request->merge([
            "phone" => Auth::user()->phone,
        ]);

        return $this->otpServices->verifyOtp($request);
    }

    private function checkUserPhone()
    {
        if (is_null(Auth::user()->phone)) {
            return $this::sendFailedResponse(__("Please add your phone"));
        }
    }

    public function updatePhone(Request $request)
    {
        $this->validate($request, [
            "phone" => "required|string|unique:users,phone," . Auth::id()
        ]);

        Auth::user()->update([
            "phone" => $request->phone,
        ]);

        return $this::sendSuccessResponse([], __("Phone Updated Successfully"));
    }
}
