<?php

namespace App\Http\Controllers\Admin\Country;

use App\Datatables\CountryDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\CountryRequest;
use App\Services\Country\CountryServices;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class CountryController extends Controller
{
    public function __construct(private readonly CountryServices $countryServices, private readonly CountryDatatables $countryDatatables)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->countryDatatables->datatables($request);
        }
        return view("admin.pages.country.index")->with([
            "columns" => $this->countryDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.country.create");
    }

    public function store(CountryRequest $request)
    {
        try {
            $this->countryServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Country Added Successfully"));
    }

    public function edit($id)
    {
        $country = $this->countryServices->findById($id);
        return view("admin.pages.country.edit")->with([
            "country" => $country
        ]);
    }

    public function update(CountryRequest $request, $id)
    {
        try {
            $this->countryServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Country Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->countryServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Country Deleted Successfully"));
    }

}
