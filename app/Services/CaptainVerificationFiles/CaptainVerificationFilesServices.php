<?php

namespace App\Services\CaptainVerificationFiles;

use App\Models\CaptainVerificationFile;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CaptainVerificationFilesServices implements ServiceInterface
{

    public function get(): array|Collection
    {

    }

    public function findById($id, $checkStatus = false): CaptainVerificationFile
    {
        return CaptainVerificationFile::query()->findOrFail($id);
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $file = $this->findById($id);

            $file->delete();

        });
    }
}
