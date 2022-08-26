<?php

namespace App\Http\Controllers\Admin\UpgradeOptions;

use App\Datatables\UpgradeOptionDatatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpgradeOptions\UpgradeOptionRequest;
use App\Services\UpgradeOptions\UpgradeOptionsServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class UpgradeOptionsController extends Controller
{
    public function __construct(private readonly UpgradeOptionDatatables $upgradeOptionDatatables, private readonly UpgradeOptionsServices $upgradeOptionsServices)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->upgradeOptionDatatables->datatables($request);
        }
        return view("admin.pages.account-upgrade-options.index")->with([
            "columns" => $this->upgradeOptionDatatables::columns()
        ]);
    }

    public function create()
    {
        return view("admin.pages.account-upgrade-options.create");
    }

    public function store(UpgradeOptionRequest $request)
    {
        try {
            $this->upgradeOptionsServices->store($request);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->with("error", $exception->getMessage())->withInput();
        }
        return back()->with("success", __("Option Created Successfully"));
    }

    public function edit($id)
    {
        return view("admin.pages.account-upgrade-options.edit")->with([
            "option" => $this->upgradeOptionsServices->findById($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->upgradeOptionsServices->update($request, $id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return back()->with("error", $exception->getMessage())->withInput();
        }
        return back()->with("success", __("Option Updated Successfully"));
    }

    public function destroy($id)
    {
        try {
            $this->upgradeOptionsServices->destroy($id);
        } catch (Exception|Throwable $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse(__("Option Deleted Successfully"));
    }
}
