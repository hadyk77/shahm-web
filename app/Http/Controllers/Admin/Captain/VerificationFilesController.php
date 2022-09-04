<?php

namespace App\Http\Controllers\Admin\Captain;

use App\Datatables\VerificationFilesDatatables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationFilesController extends Controller
{
    public function __construct(public readonly VerificationFilesDatatables $verificationFilesDatatables)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->verificationFilesDatatables->datatables($request);
        }
        return view("admin.pages.verification-files.index")->with([
            "columns" => $this->verificationFilesDatatables::columns()
        ]);
    }
}
