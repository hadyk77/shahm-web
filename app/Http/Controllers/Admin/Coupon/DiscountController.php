<?php

namespace App\Http\Controllers\Shop\Coupon;

use App\Datatables\DiscountDatatables;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\DiscountRequest;
use App\Models\Shop;
use App\Models\ShopDiscount;
use App\Services\Admin\DiscountServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class DiscountController extends Controller
{
    public function index(Request $request, DiscountDatatables $discountDatatables)
    {
        Helper::abortPermission("marketing");
        if ($request->expectsJson()) {
            return $discountDatatables->datatables($request);
        }
        return view("shop.pages.marketing.discounts.index")->with([
            "columns" => $discountDatatables::columns()
        ]);
    }

    public function create()
    {
        Helper::abortPermission("marketing");
        return view("shop.pages.marketing.discounts.create");
    }

    public function store(DiscountRequest $request)
    {
        Helper::abortPermission("marketing");
        try {
            DiscountServices::store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Discount added successfully"));
    }

    public function edit($id)
    {
        Helper::abortPermission("marketing");
        $shop = Shop::query()->findOrFail(Helper::getCurrentShopId());
        $discount = $shop->discounts()->findOrFail($id);
        return view("shop.pages.marketing.discounts.edit")->with([
            "discount" => $discount
        ]);
    }

    public function update(DiscountRequest $request, $id)
    {
        Helper::abortPermission("marketing");
        $shop = Shop::query()->findOrFail(Helper::getCurrentShopId());
        $discount = $shop->discounts()->findOrFail($id);
        try {
            DiscountServices::update($request, $discount->id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Discount updated successfully"));
    }

    public function destroy($id)
    {
        Helper::abortPermission("marketing");
        try {
            DiscountServices::destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__('Discount Deleted successfully'));
    }
}
