<?php

namespace App\Services\Services\Discount;

use App\Enums\DiscountEnum;
use App\Helper\Helper;
use App\Services\ServiceInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class DiscountServices implements ServiceInterface
{

    public function get(): array|Collection
    {
        // TODO: Implement get() method.
    }

    public function findById($id, $checkStatus = false): Model|Collection|Builder|array|null
    {
        // TODO: Implement findById() method.
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            ShopDiscount::query()->create([
                "code" => strtoupper($request->code),
                "type" => $request->type,
                "shop_id" => Helper::getCurrentShopId(),
                "amount" => $request->amount ?? null,
                "percentage" => $request->percentage ?? null,
                "quantity" => $request->quantity,
                "status" => 1,
                "quantity_number" => $request->quantity_number ?? null,
                "start_date" => $request->date("start_date"),
                "end_date" => $request->date("end_date")
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $discount = ShopDiscount::query()->where("shop_id", Helper::getCurrentShopId())->findOrFail($id);
            $discount->update([
                "code" => strtoupper($request->code),
                "type" => $request->type,
                "amount" => $request->type == DiscountEnum::AMOUNT ? $request->amount : null,
                "percentage" => $request->type == DiscountEnum::PERCENTAGE ? $request->percentage : null,
                "quantity" => $request->quantity,
                "quantity_number" => $request->quantity == DiscountEnum::LIMITED ? $request->quantity_number : null,
                "start_date" => $request->date("start_date"),
                "end_date" => $request->date("end_date")
            ]);
        });
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $discount = ShopDiscount::query()->where("shop_id", Helper::getCurrentShopId())->findOrFail($id);
            $discount->delete();
        });
    }
}
