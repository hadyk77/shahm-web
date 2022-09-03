<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\Service;
use App\Support\DataTableActions;
use DataTables;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ServiceDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "icon",
            "title",
            "rate",
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
            ->addColumn("rate", function (Service $service) {
                $rate = DB::table("rates")->where("model_type", Service::class)->where("model_id", $service->id)->avg("rate");
                $html = "";
                if (!is_null($rate)) {
                    for ($i = 0; $i < $rate; $i++) {
                        $html .= "<img style='width: 25px;' class='img-fluid' src='" . asset("admin/media/star-icon.svg") . "'/>";
                    }
                } else {
                    $html = __("No Rate Yet");
                }
                return $html;
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
            ->rawColumns(["action", "icon", "status", "rate"])
            ->make();
    }

    public function query(Request $request): Builder
    {
        return Service::query()->select('*');
    }
}
