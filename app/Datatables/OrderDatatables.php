<?php

namespace App\Datatables;

use App\Enums\OrderEnum;
use App\Helper\Helper;
use App\Models\Order;
use App\Support\DataTableActions;
use DataTables;
use Illuminate\Http\Request;

class OrderDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "order_code",
            "captainName" => ["captain.name"],
            "clientName" => ["client.name"],
            "serviceName" => ["service.title->ar"],
            "delivery_cost",
            "grand_total",
            "payment_method",
            "order_status",
            "created_at",
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("captainName", function (Order $order) {
                return $order->captain?->name ?? __("No Yet");
            })
            ->addColumn("clientName", function (Order $order) {
                return $order->client->name;
            })
            ->addColumn("serviceName", function (Order $order) {
                return $order->service->title;
            })
            ->addColumn("order_status", function (Order $order) {
                if ($order->order_status == OrderEnum::DELIVERED) {
                    return DataTableActions::bgColor("success", OrderEnum::statues()[$order->order_status]);
                }
                if ($order->order_status == OrderEnum::CANCELED) {
                    return DataTableActions::bgColor("danger", OrderEnum::statues()[$order->order_status]);
                }
                if ($order->order_status == OrderEnum::IN_PROGRESS) {
                    return DataTableActions::bgColor("info", OrderEnum::statues()[$order->order_status]);
                }
                if ($order->order_status == OrderEnum::WAITING_OFFERS) {
                    return DataTableActions::bgColor("primary", OrderEnum::statues()[$order->order_status]);
                }
            })
            ->addColumn("delivery_cost", function (Order $order) {
                return $order->delivery_cost == null ? __("No Yet") : $order->delivery_cost;
            })
            ->addColumn("grand_total", function (Order $order) {
                return $order->grand_total == null ? __("No Yet") : $order->grand_total;
            })
            ->addColumn("created_at", function (Order $order) {
                return Helper::formatDate($order->created_at);
            })
            ->addColumn("action", function (Order $order) {
                return (new DataTableActions())
                    ->show(route("admin.order.show", $order->id))
                    ->make();
            })
            ->rawColumns(["action", "order_status"])
            ->make();
    }

    public function query(Request $request)
    {
        return Order::query()
            ->with(["client", "captain", "service"])
            ->when($request->filled("status") && in_array($request->status, array_keys(OrderEnum::statues())), function ($query) use ($request) {
                $query->where('order_status', $request->status);
            })
            ->latest("orders.created_at")
            ->select("*");
    }
}
