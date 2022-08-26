<?php

namespace App\Http\Controllers\Admin\Governorate;

use App\Datatables\GovernorateDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Governorate\GovernorateRequest;
use App\Services\Governorate\GovernorateServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class GovernorateController extends Controller
{
    public function __construct(private readonly GovernorateServices $governorateServices, private readonly GovernorateDatatables $governorateDatatables)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->governorateDatatables->datatables($request);
        }
        return view("admin.pages.governorate.index")->with([
            "columns" => $this->governorateDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.governorate.create");
    }

    public function store(GovernorateRequest $request)
    {
        try {
            $this->governorateServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Governorate Added Successfully"));
    }

    public function edit($id)
    {
        $governorate = $this->governorateServices->findById($id);
        return view("admin.pages.governorate.edit")->with([
            "governorate" => $governorate
        ]);
    }

    public function update(GovernorateRequest $request, $id)
    {
        try {
            $this->governorateServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Governorate Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->governorateServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Governorate Deleted Successfully"));
    }
}
