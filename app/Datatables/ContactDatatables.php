<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\Contact;
use App\Models\ContactType;
use App\Support\DataTableActions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactDatatables
{
    public static function columns(): array
    {
        return [
            "username" => ["user.name"],
            "contactTitle" => ["contactType.title->" . \LaravelLocalization::getCurrentLocale()],
            "read",
            "created_at",
            "updated_at",
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("username", function (Contact $contact) {
                return $contact->user->name;
            })
            ->addColumn("contactTitle", function (Contact $contact) {
                return $contact->contactType->title;
            })
            ->addColumn("read", function (Contact $contact) {
                if ($contact->is_read) {
                    return DataTableActions::bgColor("success", __("Read"));
                } else {
                    return DataTableActions::bgColor("danger", __("Unread"));
                }
            })
            ->addColumn("created_at", function (Contact $contact) {
                return Helper::formatDate($contact->created_at);
            })
            ->addColumn("updated_at", function (Contact $contact) {
                return Helper::formatDate($contact->updated_at);
            })
            ->addColumn("action", function (Contact $contact) {
                return (new DataTableActions())
                    ->show(route("admin.contact.show", $contact->id))
                    ->delete(route("admin.contact.destroy", $contact->id))
                    ->make();
            })
            ->rawColumns(["action", "read"])
            ->make();
    }

    public function query(Request $request)
    {
        return Contact::query()
            ->with(["user", "contactType"])
            ->select("*");
    }
}
