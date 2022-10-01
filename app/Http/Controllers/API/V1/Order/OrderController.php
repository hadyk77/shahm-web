<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Enums\OrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Resources\Governorate\GovernorateResource;
use App\Http\Resources\Order\OrderIndexResource;
use App\Http\Resources\Order\OrderShowResource;
use App\Models\Captain;
use App\Models\Order;
use App\Models\User;
use App\Services\Order\OrderServices;
use Carbon\Carbon;
use Http\Discovery\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function getEnabledBetweenGovernorateService()
    {
        $captains = User::query()
            ->whereHas("captain", function ($query) {
                return $query
                    ->where("captains.enable_between_governorate_service", 1)
                    ->whereDate("captains.between_governorate_date", ">=", Carbon::now()->format("Y-m-d"));
            })
            ->get()
            ->map(function (User $user) {
                return [
                    "id" => $user->id,
                    "name" => $user->name,
                    "profile_image" => $user->profile_image,
                    "joined_at" => $user->created_at->format('Y'),
                    "number_of_orders" => DB::table("orders")->where("captain_id", $user->id)->where("order_status", OrderEnum::DELIVERED)->count(),
                    "rate" => 0,
                    "time" => $user->captain->between_governorate_time,
                    "date" => $user->captain->between_governorate_date,
                    "from" => GovernorateResource::make($user->captain->governorateFrom),
                    "to" => GovernorateResource::make($user->captain->governorateTo),
                ];
            });

        return $this::sendSuccessResponse($captains);
    }
}
