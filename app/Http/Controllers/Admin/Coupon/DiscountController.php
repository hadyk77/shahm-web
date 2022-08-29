<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Datatables\DiscountDatatables;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\DiscountRequest;
use App\Services\Discount\DiscountServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class DiscountController extends Controller
{

    public function __construct(private readonly DiscountDatatables $discountDatatables, protected readonly DiscountServices $discountServices)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->discountDatatables->datatables($request);
        }
        return view("admin.pages.discounts.index")->with([
            "columns" => $this->discountDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.discounts.create");
    }

    public function store(DiscountRequest $request)
    {
        try {
            $this->discountServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Discount added successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.discounts.edit")->with([
            "discount" => $this->discountServices->findById($id)
        ]);
    }

    public function update(DiscountRequest $request, $id)
    {
        try {
            $this->discountServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Discount updated successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->discountServices->findById($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__('Discount Deleted successfully'));
    }
}
