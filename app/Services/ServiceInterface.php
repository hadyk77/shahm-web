<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    public function get(): array|Collection;

    public function findById($id): Model|Collection|Builder|array|null;

    public function store($request);

    public function update($request, $id);

    public function destroy($id);
}
