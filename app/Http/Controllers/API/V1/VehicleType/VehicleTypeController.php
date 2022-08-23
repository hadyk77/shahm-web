<?php

namespace App\Http\Controllers\API\V1\VehicleType;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleType\VehicleTypeResource;
use App\Services\VehicleType\VehicleTypeServices;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function __construct(private readonly VehicleTypeServices $vehicleTypeServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(VehicleTypeResource::collection($this->vehicleTypeServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(VehicleTypeResource::make($this->vehicleTypeServices->findById($id)));
    }
}
