<?php

namespace App\Http\Controllers\Admin\Captain;

use App\Datatables\VerificationFilesDatatables;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CaptainVerificationFiles\CaptainVerificationFilesServices;
use App\Services\VerificationOptions\VerificationOptionsServices;
use Exception;
use Illuminate\Http\Request;
use Log;
use Throwable;

class VerificationFilesController extends Controller
{
    public function __construct(
        private readonly VerificationFilesDatatables      $verificationFilesDatatables,
        private readonly CaptainVerificationFilesServices $captainVerificationFilesServices
    )
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->verificationFilesDatatables->datatables($request);
        }
        return view("admin.pages.verification-files.index")->with([
            "columns" => $this->verificationFilesDatatables::columns(),
            "captains" => User::query()->where("is_captain", true)->get()
        ]);
    }

    public function show($id)
    {
        $file = $this->captainVerificationFilesServices->findById($id);

        $file->markAsRead();

        return view("admin.pages.verification-files.show")->with([
            "file" => $file
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "status" => "required|string|in:rejected,accepted"
        ]);

        try {

            $file = $this->captainVerificationFilesServices->findById($id);

            if ($request->status == "rejected") {
                $file->markAsRejected();
            }

            if ($request->status == "accepted") {
                $file->markAsAccepted();
            }

        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->withInput()->with("error", $exception->getMessage());
        }

        return back()->with("success", __("Status Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->captainVerificationFilesServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("File Deleted Successfully"));
    }

}
