<?php

namespace App\Http\Controllers\API\V1\UpgradeOptions;

use App\Http\Controllers\Controller;
use App\Http\Resources\UpgradeOptions\UpgradeOptionsResource;
use App\Services\UpgradeOptions\UpgradeOptionsServices;

class UpgradeOptionsController extends Controller
{

    public function __construct(private readonly UpgradeOptionsServices $optionsServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(UpgradeOptionsResource::collection($this->optionsServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(UpgradeOptionsResource::make($this->optionsServices->findById($id)));
    }

}
