<?php

namespace App\Http\Controllers\Admin\Order;

use App\Datatables\OrderDatatables;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderServices;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderDatatables $orderDatatables, private readonly OrderServices $orderServices)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->orderDatatables->datatables($request);
        }
        return view("admin.pages.orders.index")->with([
            "columns" => $this->orderDatatables::columns(),
        ]);
    }
}
