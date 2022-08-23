<?php

namespace App\Http\Controllers\API\V1\Country;

use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryResource;
use App\Services\Country\CountryServices;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(private readonly CountryServices $countryServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(CountryResource::collection($this->countryServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(CountryResource::make($this->countryServices->findById($id)));
    }
}
