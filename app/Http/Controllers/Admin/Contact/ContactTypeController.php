<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Datatables\ContactDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\ContactTypeRequest;
use App\Services\Contact\ContactTypeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ContactTypeController extends Controller
{

    public function __construct(private readonly ContactDatatables $contactDatatables, private readonly ContactTypeService $contactTypeService)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->contactDatatables->datatables($request);
        }
        return view("admin.pages.contact-types.index")->with([
            "columns" => $this->contactDatatables::columns(),
        ]);
    }

    public function create()
    {
        return view("admin.pages.contact-types.create");
    }

    public function store(ContactTypeRequest $request)
    {
        try {
            $this->contactTypeService->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Contact Type Created Successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.contact-types.edit")->with([
            "contactType" => $this->contactTypeService->findById($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->contactTypeService->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Contact Type Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->contactTypeService->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Contact Type Deleted Successfully"));
    }
}
