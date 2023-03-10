<?php

namespace App\Http\Controllers\Admin\Captain;

use App\Datatables\CaptainDatatables;
use App\Datatables\OrderDatatables;
use App\Datatables\VerificationFilesDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Captain\CaptainRequest;
use App\Services\Captain\CaptainServices;
use App\Services\Nationality\NationalityService;
use App\Services\User\UserServices;
use App\Services\VehicleType\VehicleTypeServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CaptainController extends Controller
{
    public function __construct(
        private readonly CaptainDatatables           $captainDatatables,
        private readonly CaptainServices             $captainService,
        private readonly UserServices                $userServices,
        private readonly VehicleTypeServices         $vehicleTypeServices,
        private readonly OrderDatatables             $orderDatatables,
        private readonly NationalityService          $nationalityService,
        private readonly VerificationFilesDatatables $verificationFilesDatatables,
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
            "vehicleTypeServices" => $this->vehicleTypeServices->get(),
            "nationalities" => $this->nationalityService->get(),
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
        if ($request->type == "orders") {
            if ($request->expectsJson()) {
                return $this->orderDatatables->datatables($request);
            }
        }

        if ($request->type == "account_upgrade") {
            if ($request->expectsJson()) {
                return $this->verificationFilesDatatables->datatables($request);
            }
        }

        return view("admin.pages.captains.show")->with([
            "user" => $this->userServices->findById($id),
            "columns" => $this->orderDatatables::columns(),
            "verificationFilesColumns" => $this->verificationFilesDatatables::columns(),
        ]);
    }

    public function edit($id)
    {
        return view("admin.pages.captains.edit")->with([
            "vehicleTypeServices" => $this->vehicleTypeServices->get(),
            "captain" => $this->captainService->findById($id),
            "nationalities" => $this->nationalityService->get(),
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
