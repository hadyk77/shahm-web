<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Services\Otp\OtpServices;
use Illuminate\Http\Request;
use Str;

class RegisterController extends Controller
{
    public function __construct(private readonly OtpServices $otpServices)
    {
    }

    public function __invoke(RegisterRequest $request)
    {
        $user = $request->register();

        return $this->otpServices->instantiateOtp($request);
    }

}
