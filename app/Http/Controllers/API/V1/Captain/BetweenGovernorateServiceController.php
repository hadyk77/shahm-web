<?php

namespace App\Http\Controllers\API\V1\Captain;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Captain\BetweenGovernorateServiceRequest;
use App\Http\Resources\Captain\BetweenGovernorateServiceResource;
use App\Models\BetweenGovernorateService;
use Auth;
use Exception;
use Log;

class BetweenGovernorateServiceController extends Controller
{
    public function index()
    {
        $services = BetweenGovernorateService::query()->where("captain_id", Auth::id())->get();
        return $this::sendSuccessResponse(BetweenGovernorateServiceResource::collection($services));
    }

    public function show($id)
    {
        $service = BetweenGovernorateService::query()->where("captain_id", Auth::id())->findOrFail($id);
        return $this::sendSuccessResponse(BetweenGovernorateServiceResource::make($service));
    }

    public function store(BetweenGovernorateServiceRequest $request)
    {
        try {
            BetweenGovernorateService::query()->create([
                "captain_id" => Auth::id(),
                "pickup_id" => $request->pickup_id,
                "drop_off_id" => $request->drop_off_id,
                "between_governorate_time" => $request->between_governorate_time,
                "between_governorate_date" => $request->between_governorate_date,
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Saved Successfully"));
    }

    public function update(BetweenGovernorateServiceRequest $request, $id)
    {
        try {
            $service = BetweenGovernorateService::query()->where('captain_id', Auth::id())->findOrFail($id);
            $service->update([
                "pickup_id" => $request->pickup_id,
                "drop_off_id" => $request->drop_off_id,
                "between_governorate_time" => $request->between_governorate_time,
                "between_governorate_date" => $request->between_governorate_date,
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Updated Successfully"));
    }

    public function destroy($id)
    {
        $service = BetweenGovernorateService::query()->where("captain_id", Auth::id())->findOrFail($id);
        $service->delete();
        return $this::sendSuccessResponse([], __("Deleted"));
    }
}
