<?php

namespace App\Http\Controllers\API\V1\Contact;

use App\Actions\NotificationActions\NotifyAdminWithNewContactMessage;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Auth;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            "contact_type_id" => "required|exists:contact_types,id",
            "message" => "required|string"
        ]);

        $contact = Contact::query()->create([
            "user_id" => Auth::id(),
            "contact_type_id" => $request->contact_type_id,
            "message" => $request->message
        ]);

        NotifyAdminWithNewContactMessage::run($contact);

        return $this::sendSuccessResponse([], __("Message Send Successfully to support"));

    }
}
