<?php

namespace App\Datatables;

use App\Models\Role;
use App\Support\DataTableActions;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use LaravelLocalization;
use Log;

class RoleDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "roleTitle" => ["title->" . LaravelLocalization::getCurrentLocale()],
            "created_at",
            "updated_at",
        ];
    }

    public function datatables($request)
    {
        try {
            return datatables($this->query($request))
                ->addColumn("action", function (Role $role) {
                    return (new DataTableActions())
                        ->edit(route("admin.role.edit", $role->id))
                        ->delete(route("admin.role.destroy", $role->id))
                        ->make();
                })
                ->addColumn("roleTitle", function (Role $role) {
                    return $role->title;
                })
                ->addColumn("created_at", function (Role $role) {
                    return $role->created_at->format('Y-m-d');
                })
                ->addColumn("updated_at", function (Role $role) {
                    return $role->updated_at->format('Y-m-d');
                })
                ->rawColumns(['action', 'created_at', 'updated_at', 'status'])
                ->make(true);
        } catch (Exception $e) {
            Log::error(get_class($this) . " Error " . $e->getMessage());
        }
    }

    public function query($request): Builder
    {
        return Role::query()->select("*");
    }
}
