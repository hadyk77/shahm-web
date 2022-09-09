<?php

namespace App\Http\Controllers\Admin\Role;

use App\Datatables\RoleDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\Role\RoleServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Log;
use Throwable;

class RoleController extends Controller
{

    public function __construct(private readonly RoleDatatables $roleDatatables, private readonly RoleServices $roleServices)
    {
    }

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->roleDatatables->datatables($request);
        }
        return view("admin.pages.roles.index")->with([
            "columns" => $this->roleDatatables::columns(),
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
        try {
            $this->roleServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with('success', __("Permission Added Successfully"));
    }

    public function edit($id): View
    {
        $permissions = Permission::query()->get();
        return view("admin.pages.roles.edit")->with([
            "role" => $this->roleServices->findById($id),
            "permissions" => $permissions,
        ]);
    }

    public function update(RoleRequest $request, $id): RedirectResponse
    {
        try {
            $this->roleServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Permission Updated Successfully"));
    }

    public function destroy($id): JsonResponse
    {
        if ($this->roleServices->findById($id)->id === 1) {
            return $this->sendFailedResponse(__("This permission can not be deleted"));
        }
        try {
            $this->roleServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Permission Deleted Successfully"));
    }
}
