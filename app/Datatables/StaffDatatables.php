<?php

namespace App\Datatables;

use App\Enums\RoleEnums;
use App\Models\User;
use App\Support\DataTableActions;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Log;

class StaffDatatables implements DatatableInterface
{
    public static function columns()
    {
        // TODO: Implement columns() method.
    }

    public function datatables($request)
    {
        try {
            return datatables($this->query($request))
                ->addColumn("user_profile_image", function (User $user) {
                    return DataTableActions::image($user->profile_user_image);
                })
                ->addColumn("action", function (User $user) {
                    return (new DataTableActions())
                        ->edit(route("admin.admin-staff.edit", $user->id))
                        ->delete(route("admin.admin-staff.destroy", $user->id))
                        ->make();
                })
                ->addColumn("status", function (User $user) {
                    return (new DataTableActions())
                        ->model($user)
                        ->modelId($user->id)
                        ->checkStatus($user->status)
                        ->switcher();
                })
                ->addColumn("created_at", function (User $user) {
                    return $user->created_at->format('Y-m-d');
                })
                ->addColumn("updated_at", function (User $user) {
                    return $user->updated_at->format('Y-m-d');
                })
                ->rawColumns(['action', 'status', 'user_profile_image'])
                ->make(true);
        } catch (Exception $e) {
            Log::error(get_class($this) . " Error " . $e->getMessage());
        }
    }

    public function query($request): Builder
    {
        return User::query()->where("id", "!=", 1)->select("*");
    }
}
