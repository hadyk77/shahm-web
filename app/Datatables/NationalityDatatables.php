<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\Nationality;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NationalityDatatables implements DatatableInterface
{

    public static function columns(): array
    {
        return [
            "title" => ['title->ar'],
            "status",
            "created_at",
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn("status", function (Nationality $nationality) {
                return (new DataTableActions())
                    ->model($nationality)
                    ->modelId($nationality->id)
                    ->checkStatus($nationality->status)
                    ->switcher();
            })
            ->addColumn("created_at", function (Nationality $nationality) {
                return Helper::formatDate($nationality->created_at);
            })
            ->addColumn("action", function (Nationality $nationality) {
                return (new DataTableActions())
                    ->edit(route("admin.nationality.edit", $nationality->id))
                    ->delete(route("admin.nationality.destroy", $nationality->id))
                    ->make();
            })
            ->rawColumns(["action", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return Nationality::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
