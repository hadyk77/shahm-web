<?php

namespace App\Http\Controllers\Admin\VehicleType;

use App\Datatables\VehicleTypeDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleType\VehicleTypeRequest;
use App\Services\VehicleType\VehicleTypeServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class VehicleTypeController extends Controller
{
    public function __construct(private readonly VehicleTypeServices $vehicleTypeServices, private readonly VehicleTypeDatatables $vehicleTypeDatatables)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->vehicleTypeDatatables->datatables($request);
        }
        return view("admin.pages.vehicle-type.index")->with([
            "columns" => $this->vehicleTypeDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.vehicle-type.create");
    }

    public function store(VehicleTypeRequest $request)
    {
        try {
            $this->vehicleTypeServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Vehicle Type Added Successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.vehicle-type.edit")->with([
            "vehicleType" => $this->vehicleTypeServices->findById($id)
        ]);
    }

    public function update(VehicleTypeRequest $request, $id)
    {
        try {
            $this->vehicleTypeServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Vehicle Type Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->vehicleTypeServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Vehicle Type Deleted Successfully"));
    }
}
