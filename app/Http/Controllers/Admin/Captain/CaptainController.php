<?php

namespace App\Http\Controllers\Admin\Captain;

use App\Datatables\CaptainDatatables;
use App\Datatables\OrderDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Captain\CaptainRequest;
use App\Services\Captain\CaptainServices;
use App\Services\User\UserServices;
use App\Services\VehicleType\VehicleTypeServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CaptainController extends Controller
{
    public function __construct(
        private readonly CaptainDatatables   $captainDatatables,
        private readonly CaptainServices     $captainService,
        private readonly UserServices        $userServices,
        private readonly VehicleTypeServices $vehicleTypeServices,
        private readonly OrderDatatables     $orderDatatables,
    )
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->captainDatatables->datatables($request);
        }
        return view("admin.pages.captains.index")->with([
            "columns" => $this->captainDatatables::columns(),
        ]);
    }

    public function create()
    {
        return view("admin.pages.captains.create")->with([
            "users" => $this->userServices->getUsersWithoutCaptains(),
            "vehicleTypeServices" => $this->vehicleTypeServices->get()
        ]);
    }

    public function store(CaptainRequest $request)
    {
        try {
            $this->captainService->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Captain Added Successfully"));
    }

    public function show(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $request->merge([
                "captain_id" => $id
            ]);
            return $this->orderDatatables->datatables($request);
        }
        return view("admin.pages.captains.show")->with([
            "captain" => $this->captainService->findById($id),
            "columns" => $this->orderDatatables::columns(),
        ]);
    }

    public function edit($id)
    {
        return view("admin.pages.captains.edit")->with([
            "vehicleTypeServices" => $this->vehicleTypeServices->get(),
            "captain" => $this->captainService->findById($id),
        ]);
    }

    public function update(CaptainRequest $request, $id)
    {
        try {
            $this->captainService->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Captain Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->captainService->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Captain Deleted Successfully"));
    }

}
