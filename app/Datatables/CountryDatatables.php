<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\Country;
use App\Support\DataTableActions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "flag",
            "title" => ['title->ar'],
            "status",
            "created_at",
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("status", function (Country $country) {
                return (new DataTableActions())
                    ->model($country)
                    ->modelId($country->id)
                    ->checkStatus($country->status)
                    ->switcher();
            })
            ->addColumn("flag", function (Country $country) {
                return DataTableActions::image($country->flag);
            })
            ->addColumn("created_at", function (Country $country) {
                return Helper::formatDate($country->created_at);
            })
            ->addColumn("action", function (Country $country) {
                return (new DataTableActions())
                    ->edit(route("admin.country.edit", $country->id))
                    ->delete(route("admin.country.destroy", $country->id))
                    ->make();
            })
            ->rawColumns(["action", "flag", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return Country::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
