<?php

namespace App\Http\Controllers\API\V1\ExpectedPriceRange;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpectedPriceRange\ExpectedPriceRangeResource;
use App\Services\ExpectedPriceRange\ExpectedPriceRangeServices;

class ExpectedPriceRangeController extends Controller
{
    public function __construct(private readonly ExpectedPriceRangeServices $expectedPriceRangeServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(ExpectedPriceRangeResource::collection($this->expectedPriceRangeServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(ExpectedPriceRangeResource::make($this->expectedPriceRangeServices->findById($id)));
    }
}
