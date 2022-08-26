<?php

namespace App\Datatables;

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
            "title",
            "created_at",
            "updated_at"
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("created_at", function (VerificationOption $verificationOption) {
                return Helper::formatDate($verificationOption->created_at);
            })
            ->addColumn("updated_at", function (VerificationOption $verificationOption) {
                return Helper::formatDate($verificationOption->updated_at);
            })
            ->addColumn("action", function (VerificationOption $verificationOption) {
                return (new DataTableActions())
                    ->edit(route("admin.banner.edit", $verificationOption->id))
                    ->delete(route("admin.banner.destroy", $verificationOption->id))
                    ->make();
            })
            ->rawColumns(["action"])
            ->make();
    }

    public function query(Request $request): Builder
    {
        return VerificationOption::query()->select("*");
    }
}
