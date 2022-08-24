<?php

namespace App\Http\Controllers\API\V1\Nationality;

use App\Http\Controllers\Controller;
use App\Http\Resources\Nationality\NationalityResource;
use App\Services\Nationality\NationalityService;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function __construct(private readonly NationalityService $nationalityService)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(NationalityResource::collection($this->nationalityService->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(NationalityResource::make($this->nationalityService->findById($id, true)));
    }
}
