<?php

namespace App\Http\Controllers\Admin\Page;

use App\Datatables\PageDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Page\PageRequest;
use App\Services\Page\PageServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class PageController extends Controller
{
    public function __construct(private readonly PageServices $pageServices, private readonly PageDatatables $pageDatatables)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->pageDatatables->datatables($request);
        }
        return view("admin.pages.page.index")->with([
            "columns" => $this->pageDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.page.create");
    }

    public function store(PageRequest $request)
    {
        try {
            $this->pageServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Page Added Successfully"));
    }

    public function edit($id)
    {
        $page = $this->pageServices->findById($id);
        return view("admin.pages.page.edit")->with([
            "page" => $page
        ]);
    }

    public function update(PageRequest $request, $id)
    {
        try {
            $this->pageServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Page Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->pageServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Page Deleted Successfully"));
    }
}
