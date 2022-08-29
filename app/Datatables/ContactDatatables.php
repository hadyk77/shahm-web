<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\ContactType;
use App\Support\DataTableActions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactDatatables
{
    public static function columns(): array
    {
        return [
            "title",
            "created_at",
            "updated_at",
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("created_at", function (ContactType $contactType) {
                return Helper::formatDate($contactType->created_at);
            })
            ->addColumn("updated_at", function (ContactType $contactType) {
                return Helper::formatDate($contactType->updated_at);
            })
            ->addColumn("action", function (ContactType $contactType) {
                return (new DataTableActions())
                    ->edit(route("admin.contact-type.edit", $contactType->id))
                    ->delete(route("admin.contact-type.destroy", $contactType->id))
                    ->make();
            })
            ->rawColumns(["action"])
            ->make();
    }

    public function query(Request $request)
    {
        return ContactType::query()->select("*");
    }
}
