<?php

namespace App\Http\Controllers\Admin\Messages;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\User\UserCustomNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessagesController extends Controller
{
    public function __invoke(Request $request, $id)
    {

        $this->validate($request, [
            "title" => "required|string",
            "body" => "required|string"
        ]);

        $user = User::query()->findOrFail($id);

        try {

            $user->notify(new UserCustomNotification($request->title, $request->body));

        } catch (Exception $exception) {

            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());

        }
        return $this::sendSuccessResponse([], __("Message Send Successfully"));
    }
}
