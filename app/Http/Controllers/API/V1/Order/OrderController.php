<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\OrderRequest;
use App\Services\Order\OrderServices;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderServices $orderServices)
    {

    }

    public function index()
    {

    }

    public function store(OrderRequest $request)
    {

    }
}
