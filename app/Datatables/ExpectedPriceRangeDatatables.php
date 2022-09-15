<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\ExpectedPriceRange;
use App\Support\DataTableActions;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpectedPriceRangeDatatables implements DatatableInterface
{

    public static function columns(): array
    {
        return [
            "kilometer",
            "price",
            "created_at",
            "updated_at",
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn("created_at", function (ExpectedPriceRange $expectedPriceRange) {
                return Helper::formatDate($expectedPriceRange->created_at);
            })
            ->addColumn("updated_at", function (ExpectedPriceRange $expectedPriceRange) {
                return Helper::formatDate($expectedPriceRange->updated_at);
            })
            ->addColumn("kilometer", function (ExpectedPriceRange $expectedPriceRange) {
                return $expectedPriceRange->kilometer_from . ' - ' . $expectedPriceRange->kilometer_to;
            })
            ->addColumn("price", function (ExpectedPriceRange $expectedPriceRange) {
                return $expectedPriceRange->price_from . ' - ' . $expectedPriceRange->price_to;
            })
            ->addColumn("action", function (ExpectedPriceRange $expectedPriceRange) {
                return (new DataTableActions())
                    ->edit(route("admin.expected-price-range.edit", $expectedPriceRange->id))
                    ->delete(route("admin.expected-price-range.destroy", $expectedPriceRange->id))
                    ->make();
            })
            ->rawColumns(["action"])
            ->make();
    }

    public function query(Request $request)
    {
        return ExpectedPriceRange::query()->select("*");
    }
}
