<?php

namespace App\Http\Controllers\API\V1\Service;

use App\Http\Controllers\Controller;
use App\Http\Resources\Service\ServiceResource;
use App\Services\BaseService\BaseServices;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private readonly BaseServices $services)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(ServiceResource::collection($this->services->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(ServiceResource::make($this->services->findById($id)));
    }
}
