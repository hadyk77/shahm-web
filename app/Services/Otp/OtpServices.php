<?php

namespace App\Services\Otp;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Models\UserVerificationOtp;
use App\Traits\HandleApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OtpServices
{
    use HandleApiResponseTrait;

    public function instantiateOtp(Request $request, $column_name = "phone"): JsonResponse
    {
        $this->validatePhone($request, $column_name);

        if (!$this->isPhoneExists($request, $column_name)) {
            return $this::sendFailedResponse(__("Invalid Phone Credentials"));
        }

        $user = $this->getUser($request, $column_name);

        $this->deleteVerificationOtpBeforeSend($request);

        $verification = UserVerificationOtp::query()->create([
            "phone" => $user->{$column_name},
            "user_id" => $user->id,
            "uuid" => Str::uuid()->toString(),
        ]);

        return $this::sendSuccessResponse([
            "otp_key" => $verification->uuid
        ]);
    }

    public function verifyOtp(Request $request, $column_name = 'phone', $is_captain = false): JsonResponse
    {
        validator($request->all(), [
            "otp_key" => "required|string",
            $column_name => "required|numeric",
        ])->validate();

        if (!$this->isOtpExists($request, $column_name)) {
            return $this::sendFailedResponse(__("Invalid Code"));
        }

        $user = $this->getUser($request, $column_name);

        $this->deleteOtp($request);

        if ($is_captain) {
            $user->update([
                "is_captain_phone_number_verified" => true
            ]);
            $data = [
                "captain_phone_number_verified" => true,
            ];
        } else {
            $user->update([
                "phone_verified_at" => Carbon::now()
            ]);
            $data = [
                "phone_verified" => true,
                "access_token" => $user->createToken("user_login_token_" . Str::random(5))->plainTextToken,
                "user" => UserResource::make($user),
            ];
        }

        return $this::sendSuccessResponse($data);

    }

    private function validatePhone(Request $request, $column_name = "phone"): void
    {
        validator($request->all(), [
            $column_name => "required|numeric",
        ])->validate();
    }

    private function isPhoneExists(Request $request, $column_name = "phone"): bool
    {
        return DB::table("users")
            ->where($column_name, $request->{$column_name})
            ->exists();
    }

    private function getUser(Request $request, $column_name = "phone"): User
    {
        return User::query()->where($column_name, $request->$column_name)->first();
    }

    private function isOtpExists(Request $request, $column_name = "phone"): bool
    {
        return DB::table("user_verification_otps")
            ->where("uuid", $request->otp_key)
            ->where("phone", $request->$column_name)
            ->exists();
    }

    private function deleteOtp(Request $request): void
    {
        DB::table("user_verification_otps")
            ->where("uuid", $request->otp_key)
            ->where("phone", $request->phone)
            ->delete();
    }

    private function deleteVerificationOtpBeforeSend(Request $request): void
    {
        UserVerificationOtp::query()->where("phone", $request->phone)->delete();
    }
}
