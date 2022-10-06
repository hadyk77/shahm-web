<?php

namespace App\Http\Controllers\API\V1\Rate;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Rate\RateRequest;
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
            "model_type" => "required|in:user,service"
        ]);

        return $this::sendSuccessResponse($this->rateServices->getUserRates($request->model_type));
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
        return $this::sendSuccessResponse($this->rateServices->findUserRateById($id));
    }
}
