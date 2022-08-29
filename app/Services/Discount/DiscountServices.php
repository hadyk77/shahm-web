<?php

namespace App\Services\Discount;

use App\Enums\DiscountEnum;
use App\Models\Coupon;
use App\Models\Discount;
use App\Services\ServiceInterface;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DiscountServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        return Discount::query()->enabled()->get();
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        if ($checkStatus) {
            return Discount::query()->enabled()->findOrFail($id);
        }
        return Discount::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            Discount::query()->create([
                "code" => strtoupper($request->code),
                "type" => $request->type,
                "amount" => $request->amount ?? null,
                "percentage" => $request->percentage ?? null,
                "quantity" => $request->quantity,
                "status" => 1,
                "quantity_number" => $request->quantity_number ?? null,
                "start_at" => $request->date("start_at"),
                "end_at" => $request->date("end_at")
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $discount = $this->findById($id);
            $discount->update([
                "code" => strtoupper($request->code),
                "type" => $request->type,
                "amount" => $request->type == DiscountEnum::AMOUNT ? $request->amount : null,
                "percentage" => $request->type == DiscountEnum::PERCENTAGE ? $request->percentage : null,
                "quantity" => $request->quantity,
                "quantity_number" => $request->quantity == DiscountEnum::LIMITED ? $request->quantity_number : null,
                "start_at" => $request->date("start_at"),
                "end_at" => $request->date("end_at")
            ]);
        });
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $discount = $this->findById($id);

            $discount->delete();
        });
    }

    public function randomOne()
    {
        return Discount::query()
            ->whereDate("start_at", "<=", Carbon::now()->format("Y-m-d"))
            ->whereDate("end_at", ">=", Carbon::now()->format("Y-m-d"))
            ->where("status", 1)
            ->first();
    }
}
