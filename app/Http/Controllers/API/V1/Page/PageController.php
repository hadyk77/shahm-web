<?php

namespace App\Http\Controllers\API\V1\Page;

use App\Http\Controllers\Controller;
use App\Http\Resources\Page\PageResource;
use App\Services\Page\PageServices;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(private readonly PageServices $pageServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(PageResource::collection($this->pageServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(PageResource::make($this->pageServices->findById($id, true)));
    }
}
