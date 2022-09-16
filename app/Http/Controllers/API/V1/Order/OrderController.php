<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Resources\Order\OrderIndexResource;
use App\Http\Resources\Order\OrderShowResource;
use App\Models\Order;
use App\Services\Order\OrderServices;
use Http\Discovery\Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class OrderController extends Controller
{
    public function __construct(private readonly OrderServices $orderServices)
    {

    }

    public function index(Request $request)
    {
        $orders = $this->orderServices->getClientOrders($request);
        return $this::sendSuccessResponse(OrderIndexResource::collection($orders));
    }

    public function show($id)
    {
        $orders = $this->orderServices->findClientOrderById($id);
        return $this::sendSuccessResponse(OrderShowResource::make($orders));
    }

    public function store(OrderRequest $request)
    {
        try {
            $this->orderServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __("Order Created Successfully"));
    }
}
