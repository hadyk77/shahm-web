<?php

namespace App\Services\Role;

use App\Http\Requests\Role\RoleRequest;
use Illuminate\Support\Str;
use App\Models\Role;

class RoleServices
{

    public static function store(RoleRequest $request): Role
    {
        $role = Role::query()->create([
            "title" => $request->title,
            "name" => Str::slug($request->get("title")["en"]),
        ]);
        $role->syncPermissions($request->permissions);
        return $role;
    }

    public static function update(RoleRequest $request, Role $role): Role
    {
        $role = tap($role)->update([
            "title" => $request->title,
            "name" => Str::slug($request->get("title")["en"]),
        ]);
        $role->syncPermissions($request->permissions);
        return $role;
    }

}
