<?php

namespace App\Services\Otp;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\UserVerificationOtp;
use App\Traits\HandleApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OtpServices
{
    use HandleApiResponseTrait;

    public function instantiateOtp(Request $request)
    {
        $this->validatePhone($request);

        if (!$this->isPhoneExists($request)) {
            return $this::sendFailedResponse(__("User not found"));
        }

        $user = $this->getUser($request);

        $verification = UserVerificationOtp::query()->create([
            "phone" => $user->phone,
            "user_id" => $user->phone,
            "uuid" => Str::uuid()->toString(),
        ]);

        return $this::sendSuccessResponse([
            "otp_key" => $verification->uuid
        ]);
    }

    public function verifyOtp(Request $request): JsonResponse
    {
        validator($request->all(), [
            "otp_key" => "required|string",
            "phone" => "required|numeric",
        ])->validate();

        if (!$this->isOtpExists($request)) {
            return $this::sendFailedResponse(__("Invalid Code"));
        }

        $user = $this->getUser($request);

        $user->update([
            "phone_verified_at" => Carbon::now()
        ]);

        $this->deleteOtp($request);

        $data = [
            "phone_verified" => true,
            "access_token" => $user->createToken("user_login_token_" . Str::random(5))->plainTextToken,
            "user" => UserResource::make($user),
        ];

        return $this::sendSuccessResponse($data);

    }

    private function validatePhone(Request $request): void
    {
        validator($request->all(), [
            "phone" => "required|numeric",
        ])->validate();
    }

    private function isPhoneExists(Request $request): bool
    {
        return DB::table("users")->where("phone", $request->phone)->exists();
    }

    private function getUser(Request $request)
    {
        return DB::table("users")->where("phone", $request->phone)->first();
    }

    private function isOtpExists(Request $request): bool
    {
        return DB::table("user_verification_otps")
            ->where("uuid", $request->otp_key)
            ->where("phone", $request->phone)
            ->exists();
    }

    private function deleteOtp(Request $request): void
    {
        DB::table("user_verification_otps")
            ->where("uuid", $request->otp_key)
            ->where("phone", $request->phone)
            ->delete();
    }
}
