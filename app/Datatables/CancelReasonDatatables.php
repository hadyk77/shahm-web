<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\CancelReason;
use App\Support\DataTableActions;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CancelReasonDatatables implements DatatableInterface
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
            ->addColumn("status", function (CancelReason $cancelReason) {
                return (new DataTableActions())
                    ->model($cancelReason)
                    ->modelId($cancelReason->id)
                    ->checkStatus($cancelReason->status)
                    ->switcher();
            })
            ->addColumn("created_at", function (CancelReason $cancelReason) {
                return Helper::formatDate($cancelReason->created_at);
            })
            ->addColumn("action", function (CancelReason $cancelReason) {
                return (new DataTableActions())
                    ->edit(route("admin.cancel-reason.edit", $cancelReason->id))
                    ->delete(route("admin.cancel-reason.destroy", $cancelReason->id))
                    ->make();
            })
            ->rawColumns(["action", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return CancelReason::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
