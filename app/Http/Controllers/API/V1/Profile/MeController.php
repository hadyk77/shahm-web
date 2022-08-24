<?php

namespace App\Http\Controllers\API\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Auth;

class MeController extends Controller
{
    public function __invoke()
    {
        return $this::sendSuccessResponse(UserResource::make(Auth::user()));
    }
}
