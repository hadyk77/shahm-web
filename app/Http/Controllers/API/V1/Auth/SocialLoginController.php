<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    public function __invoke(Request $request)
    {

        $this->validateLogin($request);

        try {
            $user = $this->getUser($request);

            $data = [
                "access_token" => $user->createToken("user_login_token_" . Str::random(5))->plainTextToken,
                "user" => UserResource::make($user),
            ];

        } catch (Exception $exception) {

            return $this::sendFailedResponse($exception->getMessage());

        }

        return $this::sendSuccessResponse($data);

    }

    public function validateLogin(Request $request)
    {
        $this->validate($request, [
            "social_login_type" => "required|in:google,apple",
            "social_login_id" => 'required|stringM',
            "email" => "required|email",
            "name" => "required|string"
        ]);
    }

    private function getUser(Request $request): User|null
    {
        $user = User::query()->where([
            "social_login_type" => $request->social_login_type,
            "social_login_id" => $request->social_login_id,
            "email" => $request->email,
        ])->first();

        if (!is_null($user)) {
            return $user;
        }

        return User::query()->create([
            "name" => $request->name,
            "email" => $request->email,
            "social_login_type" => $request->social_login_type,
            "social_login_id" => $request->social_login_id,
        ]);
    }
}
