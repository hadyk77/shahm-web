<?php

namespace App\Http\Controllers\Admin\User;

use App\Datatables\UserDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserRequest;
use App\Services\User\UserServices;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class UserController extends Controller
{
    public function __construct(private readonly UserDatatables $userDatatables, private readonly UserServices $userService)
    {

    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->userDatatables->datatables($request);
        }
        return view("admin.pages.users.index")->with([
            "columns" => $this->userDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.users.create");
    }

    public function store(UserRequest $request)
    {
        try {
            $this->userService->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("User Added Successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.users.edit")->with([
            "user" => $this->userService->findById($id),
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $this->userService->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("User Updated Successfully"));
    }


    public function destroy($id)
    {
        try {
            $this->userService->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("User Deleted Successfully"));
    }

}
