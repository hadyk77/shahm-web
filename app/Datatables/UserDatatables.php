<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\User;
use App\Support\DataTableActions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserDatatables implements DatatableInterface
{

    public static function columns(): array
    {
        return [
            "profile_image",
            "name",
            "phone",
            "email",
            "status",
            "created_at",
            "updated_at",
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn("profile_image", function (User $user) {
                return DataTableActions::image($user->profile_image);
            })
            ->addColumn("created_at", function (User $user) {
                return Helper::formatDate($user->created_at);
            })
            ->addColumn("updated_at", function (User $user) {
                return Helper::formatDate($user->updated_at);
            })
            ->addColumn("status", function (User $user) {
                return (new DataTableActions())
                    ->model($user)
                    ->modelId($user->id)
                    ->checkStatus($user->status)
                    ->switcher();
            })
            ->addColumn("action", function (User $user) {
                return (new DataTableActions())
//                    ->show(route("admin.user.show", $user->id))
                    ->edit(route("admin.user.edit", $user->id))
                    ->delete(route("admin.user.destroy", $user->id))
                    ->make();
            })
            ->rawColumns(["action", "status", "profile_image"])
            ->make();
    }

    public function query(Request $request)
    {
        return User::query()
            ->where("is_captain", false)
            ->when($request->filled("status") && $request->status == "inactive", function ($query) use ($request) {
                return $query->where("status", 0);
            })
            ->when($request->filled("status") && $request->status == "active", function ($query) use ($request) {
                return $query->where("status", 1);
            })
            ->select("*");
    }
}
