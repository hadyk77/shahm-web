<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\Page;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageDatatables implements DatatableInterface
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
            ->addColumn("status", function (Page $page) {
                return (new DataTableActions())
                    ->model($page)
                    ->modelId($page->id)
                    ->checkStatus($page->status)
                    ->switcher();
            })
            ->addColumn("created_at", function (Page $page) {
                return Helper::formatDate($page->created_at);
            })
            ->addColumn("updated_at", function (Page $page) {
                return Helper::formatDate($page->updated_at);
            })
            ->addColumn("action", function (Page $page) {
                return (new DataTableActions())
                    ->edit(route("admin.page.edit", $page->id))
                    ->delete(route("admin.page.destroy", $page->id))
                    ->make();
            })
            ->rawColumns(["action", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return Page::query()
            ->when($request->filled("status") && $request->status === StatusEnum::DEACTIVATED, function ($query) {
                $query->deactivated();
            })
            ->select("*");
    }
}
