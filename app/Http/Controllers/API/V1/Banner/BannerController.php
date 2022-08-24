<?php

namespace App\Http\Controllers\API\V1\Banner;

use App\Http\Controllers\Controller;
use App\Http\Resources\Banner\BannerResource;
use App\Services\Banner\BannerServices;
use Illuminate\Http\Request;

class BannerController extends Controller
{

    public function __construct(private readonly BannerServices $bannerServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(BannerResource::collection($this->bannerServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(BannerResource::make($this->bannerServices->findById($id, true)));
    }

}
