<?php

namespace App\Http\Controllers\API\V1\Governorate;

use App\Http\Controllers\Controller;
use App\Http\Resources\Governorate\GovernorateResource;
use App\Services\Governorate\GovernorateServices;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{

    public function __construct(private readonly GovernorateServices $governorateServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(GovernorateResource::collection($this->governorateServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(GovernorateResource::make($this->governorateServices->findById($id, true)));
    }

}
