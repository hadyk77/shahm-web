<?php

namespace App\Http\Controllers\Admin\User;

use App\Datatables\UserDatatables;
use App\Http\Controllers\Controller;
use App\Services\User\UserServices;
use Illuminate\Http\Request;

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

    public function edit($id)
    {
        return view("admin.pages.users.edit")->with([
            "user" => $this->userService->findById($id),
        ]);
    }

}
