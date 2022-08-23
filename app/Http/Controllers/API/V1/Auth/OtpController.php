<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserVerificationOtp;
use App\Services\Otp\OtpServices;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Str;

class OtpController extends Controller
{
    public function __construct(private readonly OtpServices $otpServices)
    {
    }

    public function instantiateOtp(Request $request)
    {
        return $this->otpServices->instantiateOtp($request);
    }

    public function verifyOtp(Request $request)
    {
        return $this->otpServices->verifyOtp($request);
    }

}
