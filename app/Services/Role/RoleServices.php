<?php

namespace App\Services\Role;

use App\Http\Requests\Role\RoleRequest;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Role;

class RoleServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        // TODO: Implement get() method.
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        return Role::query()->where("id", '!=', 1)->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $role = Role::query()->create([
                "title" => $request->title,
                "name" => Str::random(15),
            ]);
            $role->syncPermissions($request->permissions);
            return $role;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $role = $this->findById($id);
            $role->update([
                "title" => $request->title,
            ]);
            $role->syncPermissions($request->permissions);
            return $role;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $role = $this->findById($id);
            $role->delete();
        });
    }
}
