<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Models\Discount;
use App\Support\DataTableActions;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Log;

class DiscountDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "code",
            "type",
            "start_at",
            "end_at",
            "status",
        ];
    }

    public function datatables(Request $request)
    {
        try {
            return datatables($this->query($request))
                ->addColumn("action", function (Discount $discount) {
                    return (new DataTableActions())
                        ->edit(route("admin.discount.edit", $discount->id))
                        ->delete(route("admin.discount.destroy", $discount->id))
                        ->make();
                })
                ->addColumn("status", function (Discount $discount) {
                    return (new DataTableActions())
                        ->model($discount)
                        ->modelId($discount->id)
                        ->checkStatus($discount->status)
                        ->switcher();
                })
                ->addColumn("start_at", function (Discount $discount) {
                    return $discount->start_at->format('Y-m-d');
                })
                ->addColumn("end_at", function (Discount $discount) {
                    return $discount->end_at->format('Y-m-d');
                })
                ->rawColumns(["action", "status"])
                ->make(true);
        } catch (Exception $e) {
            Log::error(get_class($this) . " Error: " . $e->getMessage());
        }
    }

    public function query(Request $request): Builder
    {
        return Discount::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
