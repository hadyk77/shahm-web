<?php

namespace App\Http\Controllers\API\V1\CancelReason;

use App\Http\Controllers\Controller;
use App\Http\Resources\CancelReasonResource;
use App\Services\CancelReason\CancelReasonServices;

class CancelReasonController extends Controller
{

    public function __construct(private readonly CancelReasonServices $cancelReasonServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(CancelReasonResource::collection($this->cancelReasonServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(CancelReasonResource::make($this->cancelReasonServices->findById($id, true)));
    }
}
