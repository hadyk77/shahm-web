<?php

namespace App\Http\Controllers\API\V1\IntroImages;

use App\Http\Controllers\Controller;
use App\Http\Resources\IntroImages\IntroImagesResource;
use App\Services\IntroImages\IntroImagesServices;
use Illuminate\Http\Request;

class IntroImagesController extends Controller
{

    public function __construct(private readonly IntroImagesServices $introImagesServices)
    {
    }

    public function __invoke()
    {
        return $this::sendSuccessResponse(IntroImagesResource::collection($this->introImagesServices->get()));
    }
}
