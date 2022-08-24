<?php

namespace App\Http\Controllers\Admin\Nationality;

use App\Datatables\IntroImagesDatatables;
use App\Datatables\NationalityDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Nationality\NationalityRequest;
use App\Services\Nationality\NationalityService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class NationalityController extends Controller
{
    public function __construct(private readonly NationalityService $nationalityService, private readonly NationalityDatatables $nationalityDatatables)
    {

    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->nationalityDatatables->datatables($request);
        }
        return view("admin.pages.nationality.index")->with([
            "columns" => $this->nationalityDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.nationality.create");
    }

    public function store(NationalityRequest $request)
    {
        try {
            $this->nationalityService->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Nationality Added Successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.nationality.edit")->with([
            "nationality" => $this->nationalityService->findById($id)
        ]);
    }

    public function update(NationalityRequest $request, $id)
    {
        try {
            $this->nationalityService->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Nationality Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->nationalityService->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Nationality Deleted Successfully"));
    }
}
