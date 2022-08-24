<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\VehicleType;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VehicleTypeDatatables implements DatatableInterface
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
            ->addColumn("status", function (VehicleType $vehicleType) {
                return (new DataTableActions())
                    ->model($vehicleType)
                    ->modelId($vehicleType->id)
                    ->checkStatus($vehicleType->status)
                    ->switcher();
            })
            ->addColumn("created_at", function (VehicleType $vehicleType) {
                return Helper::formatDate($vehicleType->created_at);
            })
            ->addColumn("action", function (VehicleType $vehicleType) {
                return (new DataTableActions())
                    ->edit(route("admin.vehicle-type.edit", $vehicleType->id))
                    ->delete(route("admin.vehicle-type.destroy", $vehicleType->id))
                    ->make();
            })
            ->rawColumns(["action", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return VehicleType::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
