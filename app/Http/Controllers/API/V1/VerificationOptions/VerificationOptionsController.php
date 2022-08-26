<?php

namespace App\Http\Controllers\API\V1\VerificationOptions;

use App\Http\Controllers\Controller;
use App\Services\VerificationOptions\VerificationOptionsServices;

class VerificationOptionsController extends Controller
{
    public function __construct(private readonly VerificationOptionsServices $optionsServices)
    {
    }

    public function index()
    {

    }

    public function show($id)
    {

    }
}
