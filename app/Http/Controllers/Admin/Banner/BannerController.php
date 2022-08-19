<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Datatables\BannerDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\BannerRequest;
use App\Services\Banner\BannerServices;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class BannerController extends Controller
{
    public function __construct(private readonly BannerServices $bannerServices, private readonly BannerDatatables $bannerDatatables)
    {

    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->bannerDatatables->datatables($request);
        }
        return view("admin.pages.banner.index")->with([
            "columns" => $this->bannerDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.banner.create");
    }

    public function store(BannerRequest $request)
    {
        try {
            $this->bannerServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Banner Added Successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.banner.edit")->with([
            "banner" => $this->bannerServices->findWithoutStatus($id)
        ]);
    }

    public function update(BannerRequest $request, $id)
    {
        try {
            $this->bannerServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Banner Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->bannerServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Banner Deleted Successfully"));
    }

}
