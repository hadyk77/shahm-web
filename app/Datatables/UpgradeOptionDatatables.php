<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\AccountUpgradeOption;
use App\Support\DataTableActions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UpgradeOptionDatatables implements DatatableInterface
{

    public static function columns(): array
    {
        return [
            "title",
            "completed_orders_count",
            "created_at",
            "updated_at"
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("created_at", function (AccountUpgradeOption $accountUpgradeOption) {
                return Helper::formatDate($accountUpgradeOption->created_at);
            })
            ->addColumn("updated_at", function (AccountUpgradeOption $accountUpgradeOption) {
                return Helper::formatDate($accountUpgradeOption->updated_at);
            })
            ->addColumn("action", function (AccountUpgradeOption $accountUpgradeOption) {
                return (new DataTableActions())
                    ->edit(route("admin.upgrade-options.edit", $accountUpgradeOption->id))
                    ->delete(route("admin.upgrade-options.destroy", $accountUpgradeOption->id))
                    ->make();
            })
            ->rawColumns(["action"])
            ->make();
    }

    public function query(Request $request): Builder
    {
        return AccountUpgradeOption::query()->select("*");
    }
}
