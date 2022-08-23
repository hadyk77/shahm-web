<?php

namespace App\Http\Requests\API\Auth;

use App\Enums\ProfileImageEnum;
use App\Enums\UserEnum;
use App\Models\Media;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required",
            "gender" => "required|string|in:" . implode(",", array_keys(UserEnum::gender())),
            "phone" => "required|numeric|unique:users,phone",
            "date_of_birth" => "required|date",
            "email" => "required|email:dns,rfc|unique:users,email",
            "password" => "required|string|min:6",
            "app_version" => "required|string",
            "device_token" => "required|string",
            "profile_image" => "nullable|mimetypes:" . implode(",", Media::$IMAGES_MIMES_TYPES),
        ];
    }

    public function register(): User
    {
        $this->ensureIsNotRateLimited();

        $user = DB::transaction(function () {

            $user = User::query()->create([
                "name" => $this->input("name"),
                "gender" => $this->input("gender"),
                "phone" => $this->input("phone"),
                "date_of_birth" => $this->input("date_of_birth"),
                "email" => $this->input("email"),
                "password" => $this->input("password"),
                "device_token" => $this->input("device_token"),
                "app_version" => $this->input("app_version"),
            ]);

            if (request()->hasFile("profile_image")) {
                $user
                    ->addMedia(request()->file("profile_image"))
                    ->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
            }

            return $user;

        });

        if ($user) {
            RateLimiter::clear($this->throttleKey());
        }

        return $user;
    }

    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            "email" => trans('auth.throttle', [
                'seconds' => $seconds,
                "mintues" => ceil($seconds / 60)
            ])
        ]);

    }

    public function throttleKey(): string
    {
        return Str::lower($this->input("email") . "|" . $this->ip());
    }
}
