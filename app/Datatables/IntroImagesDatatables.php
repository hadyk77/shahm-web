<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\IntroImages;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IntroImagesDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "image",
            "title" => ['title->ar'],
            "status",
            "created_at",
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn("status", function (IntroImages $introImages) {
                return (new DataTableActions())
                    ->model($introImages)
                    ->modelId($introImages->id)
                    ->checkStatus($introImages->status)
                    ->switcher();
            })
            ->addColumn("image", function (IntroImages $introImages) {
                return DataTableActions::image($introImages->image, 200);
            })
            ->addColumn("created_at", function (IntroImages $introImages) {
                return Helper::formatDate($introImages->created_at);
            })
            ->addColumn("action", function (IntroImages $introImages) {
                return (new DataTableActions())
                    ->edit(route("admin.intro-image.edit", $introImages->id))
                    ->delete(route("admin.intro-image.destroy", $introImages->id))
                    ->make();
            })
            ->rawColumns(["action", "image", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return IntroImages::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
