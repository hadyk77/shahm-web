<?php

namespace App\Services\IntroImages;

use App\Enums\IntroImagesEnum;
use App\Models\IntroImages;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IntroImagesServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return IntroImages::query()->enabled()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return IntroImages::query()->enabled()->findOrFail($id);
        }
        return IntroImages::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $introImage = IntroImages::query()->create([
                "title" => $request->title,
                "description" => $request->description,
            ]);

            $this->handleImageUpload($request, $introImage);

            return $introImage;

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $introImage = $this->findById($id);

            $introImage->update([
                "title" => $request->title,
                "description" => $request->description,
            ]);

            $this->handleImageUpload($request, $introImage);

            return $introImage;

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $introImage = $this->findById($id);

            $introImage->delete();

        });
    }

    private function handleImageUpload($request, Model|Builder|\App\Models\BaseModel $introImage)
    {
        if ($request->hasFile('image')) {
            $introImage->addMedia($request->image)->toMediaCollection(IntroImagesEnum::IMAGE);
        }
    }
}
