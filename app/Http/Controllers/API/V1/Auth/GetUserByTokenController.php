<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
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

        $data = [
            "access_token" => $request->access_token,
            "user" => UserResource::make($user)
        ];

        return $this::sendSuccessResponse($data);
    }
}
