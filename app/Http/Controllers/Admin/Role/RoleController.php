<?php

namespace App\Http\Controllers\Admin\Role;

use App\Datatables\RoleDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\Role\RoleServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function __;
use function back;


class RoleController extends Controller
{
    public function index(Request $request, RoleDatatables $roleDatatables)
    {
        if ($request->wantsJson()) {
            return $roleDatatables->datatables($request);
        }
        return view("admin.pages.roles.index")->with([
            "columns" => $roleDatatables::columns(),
        ]);
    }

    public function create(): View
    {
        $permissions = Permission::query()->get();
        return view("admin.pages.roles.create")->with([
            "permissions" => $permissions,
        ]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        RoleServices::store($request);
        return back()->with('success', __("Role Added Successfully"));
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::query()->get();
        return \view("admin.pages.roles.edit")->with([
            "role" => $role,
            "permissions" => $permissions,
        ]);
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        RoleServices::update($request, $role);
        return back()->with("success", __("Role Updated Successfully"));
    }

    public function destroy(Role $role): JsonResponse
    {
        if ($role->id === 1) {
            return $this->sendFailedResponse(__("This role can not be deleted"));
        }
        $role->delete();
        return $this::sendSuccessResponse(__("Role Deleted Successfully"));
    }
}
