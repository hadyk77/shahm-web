<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Datatables\BannerDatatables;
use App\Http\Controllers\Controller;
use App\Services\Banner\BannerServices;
use Illuminate\Http\Request;

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

    public function store()
    {

    }

    public function edit()
    {
        return view("admin.pages.banner.create");
    }


    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

}
