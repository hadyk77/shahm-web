<?php

namespace App\Http\Controllers\Admin\IntroImage;

use App\Datatables\BannerDatatables;
use App\Datatables\IntroImagesDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IntroImage\IntroImageRequest;
use App\Services\IntroImages\IntroImagesServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Exceptions\InvalidBase64Data;
use Throwable;

class IntroImageController extends Controller
{
    public function __construct(private readonly IntroImagesServices $introImagesServices, private readonly IntroImagesDatatables $introImagesDatatables)
    {

    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->introImagesDatatables->datatables($request);
        }
        return view("admin.pages.intro-images.index")->with([
            "columns" => $this->introImagesDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.intro-images.create");
    }

    public function store(IntroImageRequest $request)
    {
        try {
            $this->introImagesServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Intro Image Added Successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.intro-images.edit")->with([
            "introImage" => $this->introImagesServices->findById($id)
        ]);
    }

    public function update(IntroImageRequest $request, $id)
    {
        try {
            $this->introImagesServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }
        return back()->with("success", __("Intro Image Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->introImagesServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Intro Image Deleted Successfully"));
    }
}
