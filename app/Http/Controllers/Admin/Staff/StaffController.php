<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Datatables\StaffDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Staff\StaffRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\Staff\StaffServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Log;
use Throwable;


class StaffController extends Controller
{

    public function __construct(private readonly StaffDatatables $staffDatatables, private readonly StaffServices $staffServices)
    {
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->staffDatatables->datatables($request);
        }
        return view("admin.pages.staffs.index")->with([
            "columns" => $this->staffDatatables::columns()
        ]);
    }

    public function create()
    {
        $roles = Role::query()->get();
        return view("admin.pages.staffs.create")->with([
            "roles" => $roles,
        ]);
    }

    public function store(StaffRequest $request): RedirectResponse
    {
        try {
            $this->staffServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Staff Added Successfully"));
    }

    public function edit($id)
    {
        $roles = Role::query()->get();
        return view("admin.pages.staffs.edit")->with([
            "staff" => $this->staffServices->findById($id),
            "roles" => $roles,
        ]);
    }

    public function update(StaffRequest $request, $id): RedirectResponse
    {
        try {
            $this->staffServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Staff Updated Successfully"));
    }

    public function destroy($id): JsonResponse
    {
        if (intval($id) == 1) {
            return $this->sendFailedResponse(__("This user can not be deleted"));
        }

        try {
            $this->staffServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse(__("Staff Deleted Successfully"));
    }
}
