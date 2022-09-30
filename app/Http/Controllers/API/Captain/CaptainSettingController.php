<?php

namespace App\Http\Controllers\API\Captain;

use App\Http\Controllers\Controller;
use App\Http\Resources\Captain\CaptainResource;
use Auth;
use Illuminate\Http\Request;

class CaptainSettingController extends Controller
{
    public function toggleOrders()
    {
        $captain = Auth::user()->captain;

        $captain->update([
            "enable_order" => !$captain->enable_order,
        ]);

        $captain->refresh();

        return $this::sendSuccessResponse([
            "enable_order" => $captain->enable_order == 1
        ]);
    }

    public function toggleBetweenGovernorateService()
    {
        $captain = Auth::user()->captain;

        $captain->update([
            "enable_between_governorate_service" => !$captain->enable_between_governorate_service,
        ]);

        $captain->refresh();

        return $this::sendSuccessResponse([
            "enable_between_governorate_service" => $captain->enable_between_governorate_service == 1
        ]);
    }

    public function updateBetweenGovernorateService(Request $request)
    {
        $this->validate($request, [
            "pickup_id" => "required|exists:governorates,id",
            "pickup_details" => "nullable|string",
            "drop_off_id" => "required|exists:governorates,id",
            "drop_off_details" => "nullable|string",
            "date" => "required|after_or_equal:today|date:Y-m-d",
            "time" => "required",
        ]);

        $captain = Auth::user()->captain;

        $captain->update([
            "enable_between_governorate_service" => 1,
            "pickup_id" => $request->pickup_id,
            "pickup_details" => $request->pickup_details,
            "drop_off_id" => $request->drop_off_id,
            "drop_off_details" => $request->drop_off_details,
            "between_governorate_time" => $request->time,
            "between_governorate_date" => $request->date,
        ]);

        return $this::sendSuccessResponse(CaptainResource::make($captain));
    }
}
