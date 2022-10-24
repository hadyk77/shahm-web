<?php

namespace App\Http\Controllers\Admin\CancelReason;

use App\Datatables\CancelReasonDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CancelReason\CancelReasonRequest;
use App\Services\CancelReason\CancelReasonServices;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class CancelReasonController extends Controller
{
    public function __construct(private readonly CancelReasonServices $cancelReasonServices, private readonly CancelReasonDatatables $cancelReasonDatatables)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->cancelReasonDatatables->datatables($request);
        }
        return view("admin.pages.cancel-reason.index")->with([
            "columns" => $this->cancelReasonDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.cancel-reason.create");
    }

    public function store(CancelReasonRequest $request)
    {
        try {
            $this->cancelReasonServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Cancel Reason Added Successfully"));
    }

    public function edit($id)
    {
        $cancelReason = $this->cancelReasonServices->findById($id);
        return view("admin.pages.cancel-reason.edit")->with([
            "cancelReason" => $cancelReason
        ]);
    }

    public function update(CancelReasonRequest $request, $id)
    {
        try {
            $this->cancelReasonServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Cancel Reason Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->cancelReasonServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Cancel Reason Deleted Successfully"));
    }
}
