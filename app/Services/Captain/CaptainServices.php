<?php

namespace App\Services\Captain;

use App\Enums\CaptainEnum;
use App\Enums\ProfileImageEnum;
use App\Enums\UserEnum;
use App\Models\AccountUpgradeOption;
use App\Models\Captain;
use App\Models\CaptainVerificationFile;
use App\Models\User;
use App\Services\ServiceInterface;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CaptainServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Captain::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return Captain::query()->where("status", 1)->findOrFail($id);
        }
        return Captain::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $this->checkThatUserHasOnlyOneCaptainAccount($request->user_id);

            $user = User::query()->find($request->user_id);

            if ($request->filled('name')) {
                $user->update([
                    "name" => $request->name
                ]);
            }

            if ($request->filled('date_of_birth')) {
                $user->update([
                    "date_of_birth" => $request->date_of_birth
                ]);
            }

            if ($request->filled('address')) {
                $user->update([
                    "address" => $request->address
                ]);
            }

            if ($request->filled('image')) {
                $user->addMedia($request->image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
            }

            $captain = Captain::query()->create([
                "user_id" => $request->user_id,
                "vehicle_type_id" => $request->vehicle_type_id,
                "nationality_id" => $request->nationality_id,
                "governorate_id" => $request->governorate_id,
                "identification_number" => $request->identification_number,
                "vehicle_manufacturing_date" => $request->vehicle_manufacturing_date,
                "account_upgrade_option_id" => AccountUpgradeOption::query()->first()->id,
                "wallet_number" => $request->wallet_number,
                "vehicle_identification_number" => $request->vehicle_identification_number,
                "vehicle_license_plate_number" => $request->vehicle_license_plate_number,
            ]);

            $captain->user->update([
                "is_captain" => true,
            ]);

            $this->handleCaptainImages($request, $captain);

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $captain = $this->findById($id);

            $captain->update([
                "vehicle_type_id" => $request->vehicle_type_id,
                "nationality_id" => $request->nationality_id,
                "identification_number" => $request->identification_number,
                "wallet_number" => $request->wallet_number,
                "vehicle_manufacturing_date" => $request->vehicle_manufacturing_date,
                "vehicle_number" => $request->vehicle_number,
                "vehicle_identification_number" => $request->vehicle_identification_number,
                "vehicle_license_plate_number" => $request->vehicle_license_plate_number,
            ]);

            $this->handleCaptainImages($request, $captain);

        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $captain = $this->findById($id);

            $captain->user->update([
                "is_captain" => false,
            ]);

            $captain->delete();

        });
    }

    public function handleCaptainImages($request, Model|Captain|Builder $captain): void
    {
        if ($request->hasFile('license_from_front')) {
            $captain->addMedia($request->license_from_front)->toMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_FRONT);
        }

        if ($request->hasFile('license_from_back')) {
            $captain->addMedia($request->license_from_back)->toMediaCollection(CaptainEnum::LICENSE_PICTURE_FROM_BACK);
        }

        if ($request->hasFile('car_picture_from_front')) {
            $captain->addMedia($request->car_picture_from_front)->toMediaCollection(CaptainEnum::CAR_PICTURE_FROM_FRONT);
        }

        if ($request->hasFile('car_picture_from_back')) {
            $captain->addMedia($request->car_picture_from_back)->toMediaCollection(CaptainEnum::CAR_PICTURE_FROM_BACK);
        }

        if ($request->hasFile('identification_from_back')) {
            $captain->addMedia($request->identification_from_back)->toMediaCollection(CaptainEnum::IDENTIFICATION_FROM_BACK);
        }

        if ($request->hasFile('identification_from_front')) {
            $captain->addMedia($request->identification_from_front)->toMediaCollection(CaptainEnum::IDENTIFICATION_FROM_FRONT);
        }


        if ($request->hasFile('coronavirus_certificate')) {
            $verificationFile = CaptainVerificationFile::query()->create([
                "captain_id" => $captain->id,
                "verification_option_id" => 1,
                "user_id" => $captain->user->id,
            ]);
            $verificationFile->addMedia($request->coronavirus_certificate)->toMediaCollection(CaptainEnum::VERIFICATION_FILE);
        }

        if ($request->hasFile('no_criminal_record_certificate')) {
            $verificationFile = CaptainVerificationFile::query()->create([
                "captain_id" => $captain->id,
                "verification_option_id" => 2,
                "user_id" => $captain->user->id,
            ]);
            $verificationFile->addMedia($request->no_criminal_record_certificate)->toMediaCollection(CaptainEnum::VERIFICATION_FILE);
        }
    }

    public function checkThatUserHasOnlyOneCaptainAccount($user_id)
    {
        $count = DB::table("captains")->where("user_id", $user_id)->count();
        if ($count >= 1) {
            throw new Exception(__("Captain already has one account"));
        }
    }

}
