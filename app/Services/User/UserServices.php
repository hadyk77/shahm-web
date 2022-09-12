<?php

namespace App\Services\User;

use App\Actions\Transactions\AddTransactionAction;
use App\Actions\Transactions\AddTransactionToUserWalletAction;
use App\Enums\ProfileImageEnum;
use App\Enums\TransactionEnum;
use App\Http\Requests\Admin\User\UserTransactionRequest;
use App\Models\User;
use App\Services\ServiceInterface;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return User::query()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return User::query()->where("status", 1)->findOrFail($id);
        }
        return User::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {

            $user = User::query()->create([
                "name" => $request->name,
                "phone" => $request->phone,
                "address" => $request->address,
                "phone_verified_at" => Carbon::now(),
                "email" => $request->email,
                "date_of_birth" => $request->date_of_birth,
                "gender" => $request->gender,
            ]);

            if ($request->hasFile("profile_image")) {
                $user->addMedia($request->profile_image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
            }

        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $user = $this->findById($id);

            $user->update([
                "name" => $request->name,
                "phone" => $request->phone,
                "address" => $request->address,
                "email" => $request->email,
                "date_of_birth" => $request->date_of_birth,
                "gender" => $request->gender,
            ]);

            if ($request->hasFile("profile_image")) {
                $user->addMedia($request->profile_image)->toMediaCollection(ProfileImageEnum::PROFILE_IMAGE);
            }
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {

            $user = $this->findById($id);

            $user->delete();

        });
    }

    public function getUsersWithoutCaptains(): Collection|array
    {
        return User::query()->where("is_captain", false)->get();
    }

    public function addTransaction(UserTransactionRequest $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $user = $this->findById($id);

            AddTransactionToUserWalletAction::run(user: $user, amount: $request->amount, notes: $request->notes, accountType: $request->accountType);

        });
    }
}
