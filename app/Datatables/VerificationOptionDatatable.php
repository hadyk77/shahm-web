<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\VerificationOption;
use App\Support\DataTableActions;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VerificationOptionDatatable implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "icon",
            "active_icon",
            "title",
            "status",
            "created_at",
            "updated_at"
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("icon", function (VerificationOption $verificationOption) {
                return DataTableActions::image($verificationOption->icon);
            })
            ->addColumn("active_icon", function (VerificationOption $verificationOption) {
                return DataTableActions::image($verificationOption->active_icon);
            })
            ->addColumn("created_at", function (VerificationOption $verificationOption) {
                return Helper::formatDate($verificationOption->created_at);
            })
            ->addColumn("status", function (VerificationOption $verificationOption) {
                return (new DataTableActions())
                    ->model($verificationOption)
                    ->modelId($verificationOption->id)
                    ->checkStatus($verificationOption->status)
                    ->switcher();
            })
            ->addColumn("updated_at", function (VerificationOption $verificationOption) {
                return Helper::formatDate($verificationOption->updated_at);
            })
            ->addColumn("action", function (VerificationOption $verificationOption) {
                return (new DataTableActions())
                    ->edit(route("admin.verification-options.edit", $verificationOption->id))
                    ->delete(route("admin.verification-options.destroy", $verificationOption->id))
                    ->make();
            })
            ->rawColumns(["action", "icon", "status", 'active_icon'])
            ->make();
    }

    public function query(Request $request)
    {
        return VerificationOption::query()->select("*");
    }
}
