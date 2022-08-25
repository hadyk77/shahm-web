<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\Service;
use App\Support\DataTableActions;
use DataTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ServiceDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "icon",
            "title",
            "status",
            "updated_at"
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("status", function (Service $service) {
                return (new DataTableActions())
                    ->model($service)
                    ->modelId($service->id)
                    ->checkStatus($service->status)
                    ->switcher();
            })
            ->addColumn("icon", function (Service $service) {
                return DataTableActions::image($service->icon);
            })
            ->addColumn("updated_at", function (Service $service) {
                return Helper::formatDate($service->updated_at);
            })
            ->addColumn("action", function (Service $service) {
                return (new DataTableActions())
                    ->edit(route("admin.service.edit", $service->id))
                    ->make();
            })
            ->rawColumns(["action", "icon", "status"])
            ->make();
    }

    public function query(Request $request): Builder
    {
        return Service::query()->select('*');
    }
}
