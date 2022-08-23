<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Str;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = $request->register();

        $data = [
            "access_token" => $user->createToken("user_login_token_" . Str::random(5))->plainTextToken,
            "user" => UserResource::make($user),
        ];

        return $this::sendSuccessResponse($data);
    }


}
