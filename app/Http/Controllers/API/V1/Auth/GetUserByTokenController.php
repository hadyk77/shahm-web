<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class GetUserByTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            "access_token" => "required|string"
        ]);

        $user = PersonalAccessToken::findToken($request->access_token);

        if (is_null($user)) {

            return $this::sendFailedResponse(__("User not found"));

        }

        $currentUser = User::query()->find($user->tokenable->id);

        $data = [
            "access_token" => $currentUser->createToken("user_login_token_" . Str::random(5))->plainTextToken,
            "user" => UserResource::make($currentUser),
        ];

        return $this::sendSuccessResponse($data);
    }
}
