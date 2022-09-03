<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Datatables\ContactDatatables;
use App\Http\Controllers\Controller;
use App\Services\Contact\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct(private readonly ContactDatatables $contactDatatables, private readonly ContactService $contactService)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->contactDatatables->datatables($request);
        }
        return view("admin.pages.contact.index")->with([
            "columns" => $this->contactDatatables::columns(),
        ]);
    }

    public function show($id)
    {
        $contact = $this->contactService->findById($id);
        $contact->update([
            "is_read" => 1
        ]);
        return view("admin.pages.contact.show")->with([
            "contact" => $contact
        ]);
    }

    public function destroy($id)
    {
        //
    }
}
