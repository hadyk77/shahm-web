<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\Banner;
use App\Support\DataTableActions;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BannerDatatables implements DatatableInterface
{

    public static function columns(): array
    {
        return [
            "image",
            "title" => ['title->ar'],
            "order",
            "status",
            "created_at",
            "updated_at",
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn("status", function (Banner $banner) {
                return (new DataTableActions())
                    ->model($banner)
                    ->modelId($banner->id)
                    ->checkStatus($banner->status)
                    ->switcher();
            })
            ->addColumn("image", function (Banner $banner) {
                return DataTableActions::image($banner->image, 100);
            })
            ->addColumn("created_at", function (Banner $banner) {
                return Helper::formatDate($banner->created_at);
            })
            ->addColumn("updated_at", function (Banner $banner) {
                return Helper::formatDate($banner->updated_at);
            })
            ->addColumn("action", function (Banner $banner) {
                return (new DataTableActions())
                    ->edit(route("admin.banner.edit", $banner->id))
                    ->delete(route("admin.banner.destroy", $banner->id))
                    ->make();
            })
            ->rawColumns(["action", "image", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return Banner::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
