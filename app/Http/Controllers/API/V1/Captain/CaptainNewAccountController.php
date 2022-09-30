<?php

namespace App\Http\Controllers\API\V1\Captain;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Captain\NewAccountRequest;
use App\Services\Captain\CaptainServices;
use App\Services\Otp\OtpServices;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class CaptainNewAccountController extends Controller
{

    public function __construct(
        private readonly OtpServices     $otpServices,
        private readonly CaptainServices $captainServices
    )
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

    public function openNewAccount(NewAccountRequest $request)
    {
        if (!Auth::user()->is_captain_phone_number_verified) {
            return Controller::sendFailedResponse(__("Your Captain Phone is not verified"));
        }
        try {

            $request->merge([
                "user_id" => Auth::id()
            ]);

            $this->captainServices->store($request);

        } catch (Exception|Throwable $exception) {

            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Account Created Successfully"));
    }
}
