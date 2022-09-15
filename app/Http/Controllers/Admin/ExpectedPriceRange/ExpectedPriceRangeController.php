<?php

namespace App\Http\Controllers\Admin\ExpectedPriceRange;

use App\Datatables\ExpectedPriceRangeDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExpectedPriceRangeRequest;
use App\Services\ExpectedPriceRange\ExpectedPriceRangeServices;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class ExpectedPriceRangeController extends Controller
{
    public function __construct(private readonly ExpectedPriceRangeServices $expectedPriceRangeServices, private readonly ExpectedPriceRangeDatatables $expectedPriceRangeDatatables)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->expectedPriceRangeDatatables->datatables($request);
        }
        return view("admin.pages.expected-price-range.index")->with([
            "columns" => $this->expectedPriceRangeDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.expected-price-range.create");
    }

    public function store(ExpectedPriceRangeRequest $request)
    {
        try {
            $this->expectedPriceRangeServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Expected Price Range Added Successfully"));
    }

    public function edit($id)
    {
        $price = $this->expectedPriceRangeServices->findById($id);
        return view("admin.pages.expected-price-range.edit")->with([
            "price" => $price
        ]);
    }

    public function update(ExpectedPriceRangeRequest $request, $id)
    {
        try {
            $this->expectedPriceRangeServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Expected Price Range Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->expectedPriceRangeServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Expected Price Range Deleted Successfully"));
    }
}
