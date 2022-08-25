<?php

namespace App\Services\BaseService;

use App\Enums\ServiceEnum;
use App\Models\Service;
use App\Models\ServiceUsage;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseServices implements ServiceInterface
{
    public function get(): array|Collection
    {
        return Service::query()->enabled()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return Service::query()->enabled()->findOrFail($id);
        }
        return Service::query()->findOrFail($id);
    }

    public function store($request)
    {
        abort(404);
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $service = $this->findById($id);

            $service->update([
                "title" => $request->title,
                "description" => $request->description,
            ]);

            if ($request->hasFile('icon')) {

                $service->addMedia($request->icon)->toMediaCollection(ServiceEnum::ICON);

            }

            foreach ($request->service_usage as $service_usage) {

                $updated_service_usage = ServiceUsage::query()
                    ->where("service_id", $id)
                    ->updateOrCreate([
                        "id" => $service_usage["id"] ?? null,
                    ], [
                        "title" => $service_usage['title'],
                        "description" => $service_usage['description'],
                    ]);

                if (isset($service_usage['icon'])) {
                    $updated_service_usage->addMedia($service_usage['icon'])->toMediaCollection(ServiceEnum::USAGE_ICON);
                }

            }
            ServiceUsage::query()->where("service_id", $id)->whereNotIn("id", collect($request->service_usage)->pluck("id")->toArray())->delete();
        });
    }

    public function destroy($id)
    {
        abort(404);
    }
}
