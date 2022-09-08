<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Datatables\StaffDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\StaffRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\Staff\StaffServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function __;
use function back;


class StaffController extends Controller
{
    public function index(Request $request, StaffDatatables $staffDatatables)
    {
        if ($request->wantsJson()) {
            return $staffDatatables->datatables($request);
        }
        return view("admin.pages.staffs.index");
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
        StaffServices::store($request);
        return back()->with("success", __("Staff Added Successfully"));
    }

    public function edit($id)
    {
        $staff = User::query()->where("id", "!=", 1)->findOrFail($id);
        $roles = Role::query()->get();
        return view("admin.pages.staffs.edit")->with([
            "staff" => $staff,
            "roles" => $roles,
        ]);
    }

    public function update(StaffRequest $request, $id): RedirectResponse
    {
        StaffServices::update($request, $id);
        return back()->with("success", __("Staff Updated Successfully"));
    }

    public function destroy($id): JsonResponse
    {
        if (intval($id) == 1) {
            return $this->sendFailedResponse(__("This user can not be deleted"));
        }
        $staff = User::query()->findOrFail($id);
        $staff->delete();
        return $this::sendSuccessResponse(__("Staff Deleted Successfully"));
    }
}
