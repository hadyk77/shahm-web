<?php

namespace App\Http\Controllers\API\V1\Rate;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Rate\RateRequest;
use App\Http\Resources\Rate\RateResource;
use App\Models\Captain;
use App\Models\Service;
use App\Models\User;
use App\Services\Rate\RateServices;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class RateController extends Controller
{
    public function __construct(private readonly RateServices $rateServices)
    {

    }

    public function index(Request $request)
    {
        $this->validate($request, [
            "model_type" => "required|in:user,service,captain"
        ]);

        $type = Service::class;

        if ($request->model_type == "user") {
            $type = User::class;
        }
        if ($request->model_type == "captain") {
            $type = Captain::class;
        }

        return $this::sendSuccessResponse($this->rateServices->getUserRates($type));
    }

    public function store(RateRequest $request)
    {
        try {
            $this->rateServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Rate Done Successfully"));
    }

    public function show($id)
    {
        $rate = $this->rateServices->findUserRateById($id);
        return $this::sendSuccessResponse(RateResource::make($rate));
    }
}
