<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\CaptainVerificationFile;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VerificationFilesDatatables implements DatatableInterface
{

    public static function columns(): array
    {
        return [
            "captainName" => ["captain.user.name"],
            "option" => ['option.title->ar'],
            "status",
            "created_at",
            "updated_at",
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn("status", function (CaptainVerificationFile $captainVerificationFile) {
                if ($captainVerificationFile->status) {
                    return DataTableActions::bgColor("success", __("Accepted"));
                }
                if (!$captainVerificationFile->is_read) {
                    return DataTableActions::bgColor("danger", __("Not Read"));
                }
                return DataTableActions::bgColor("danger", __("Rejected"));
            })
            ->addColumn("captainName", function (CaptainVerificationFile $captainVerificationFile) {
                return $captainVerificationFile->captain->user->name;
            })
            ->addColumn("option", function (CaptainVerificationFile $captainVerificationFile) {
                return $captainVerificationFile->option->title;
            })
            ->addColumn("created_at", function (CaptainVerificationFile $captainVerificationFile) {
                return Helper::formatDate($captainVerificationFile->created_at);
            })
            ->addColumn("updated_at", function (CaptainVerificationFile $captainVerificationFile) {
                return Helper::formatDate($captainVerificationFile->updated_at);
            })
            ->addColumn("action", function (CaptainVerificationFile $captainVerificationFile) {
                return (new DataTableActions())
                    ->show(route("admin.verification-files.show", $captainVerificationFile->id))
                    ->delete(route("admin.verification-files.destroy", $captainVerificationFile->id))
                    ->make();
            })
            ->rawColumns(["action", "status"])
            ->make();
    }

    public function query(Request $request)
    {
        return CaptainVerificationFile::query()
            ->when($request->filled("captain_id") && $request->captain_id != "" && $request->captain_id != "all", function ($query) {
                $query->where('captain_id', request()->captain_id);
            })
            ->when($request->filled("status") && $request->status != "" && $request->status != "all", function ($query) {
                if (\request()->status == "accepted") {
                    return $query->where("status", 1);
                }
                if (\request()->status == "rejected") {
                    return $query
                        ->where("status", 0)
                        ->where('is_read', 1);
                }
                if (\request()->status == "not_read") {
                    return $query->where("is_read", 0);
                }
                if (\request()->status == "is_read") {
                    return $query->where("is_read", 1);
                }
            })
            ->with(["captain.user", "option"])
            ->select("*");
    }
}
