<?php

namespace App\Http\Controllers\API\V1\ContactType;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactType\ContactTypeResource;
use App\Services\Contact\ContactTypeService;

class ContactTypeController extends Controller
{

    public function __construct(private readonly ContactTypeService $contactTypeService)
    {
    }

    public function __invoke()
    {
        return $this::sendSuccessResponse(ContactTypeResource::collection($this->contactTypeService->get()));
    }
}
