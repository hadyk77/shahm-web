<?php

namespace App\Http\Controllers\Admin\Service;

use App\Datatables\ServiceDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\ServiceRequest;
use App\Services\BaseService\BaseServices;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class ServiceController extends Controller
{
    public function __construct(private readonly ServiceDatatables $serviceDatatables, private readonly BaseServices $services)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->serviceDatatables->datatables($request);
        }
        return view("admin.pages.service.index")->with([
            "columns" => $this->serviceDatatables::columns()
        ]);
    }

    public function edit($id)
    {
        $service = $this->services->findById($id);
        return view("admin.pages.service.edit")->with([
            "service" => $service
        ]);
    }

    public function update(ServiceRequest $request, $id)
    {
        try {
            $this->services->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Service Updated Successfully"));
    }
}
