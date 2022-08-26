<?php

namespace App\Http\Controllers\API\V1\VerificationOptions;

use App\Http\Controllers\Controller;
use App\Http\Resources\VerificationOptions\VerificationOptionsResource;
use App\Services\VerificationOptions\VerificationOptionsServices;

class VerificationOptionsController extends Controller
{
    public function __construct(private readonly VerificationOptionsServices $optionsServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(VerificationOptionsResource::collection($this->optionsServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(VerificationOptionsResource::make($this->optionsServices->findById($id, true)));
    }
}
