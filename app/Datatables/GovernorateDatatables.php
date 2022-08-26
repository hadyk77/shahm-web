<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\Governorate;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GovernorateDatatables
{
    public static function columns(): array
    {
        return [
            "title" => ['title->ar'],
            "status",
            "created_at",
            "updated_at",
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn("status", function (Governorate $governorate) {
                return (new DataTableActions())
                    ->model($governorate)
                    ->modelId($governorate->id)
                    ->checkStatus($governorate->status)
                    ->switcher();
            })
            ->addColumn("created_at", function (Governorate $governorate) {
                return Helper::formatDate($governorate->created_at);
            })
            ->addColumn("updated_at", function (Governorate $governorate) {
                return Helper::formatDate($governorate->updated_at);
            })
            ->addColumn("action", function (Governorate $governorate) {
                return (new DataTableActions())
                    ->edit(route("admin.governorate.edit", $governorate->id))
                    ->delete(route("admin.governorate.destroy", $governorate->id))
                    ->make();
            })
            ->rawColumns(["action", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return Governorate::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
