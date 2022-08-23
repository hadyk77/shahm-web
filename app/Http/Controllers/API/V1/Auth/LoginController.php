<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Services\Otp\OtpServices;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct(private readonly OtpServices $otpServices)
    {
    }

    public function __invoke(Request $request)
    {
        return $this->otpServices->instantiateOtp($request);
    }
}
