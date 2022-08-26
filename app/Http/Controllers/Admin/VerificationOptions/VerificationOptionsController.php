<?php

namespace App\Http\Controllers\Admin\VerificationOptions;

use App\Datatables\VerificationOptionDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VerificationOptions\VerificationOptionRequest;
use App\Services\VerificationOptions\VerificationOptionsServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class VerificationOptionsController extends Controller
{
    public function __construct(private readonly VerificationOptionDatatable $verificationOptionDatatable, private readonly VerificationOptionsServices $verificationOptionsServices)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->verificationOptionDatatable->datatables($request);
        }
        return view("admin.pages.verification-options.index")->with([
            "columns" => $this->verificationOptionDatatable::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.verification-options.create");
    }

    public function store(VerificationOptionRequest $request)
    {
        try {
            $this->verificationOptionsServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Option Created Successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.verification-options.edit")->with([
            "option" => $this->verificationOptionsServices->findById($id)
        ]);
    }

    public function update(VerificationOptionRequest $request, $id)
    {
        try {
            $this->verificationOptionsServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Option Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->verificationOptionsServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Option Deleted Successfully"));
    }
}
