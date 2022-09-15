<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Datatables\TransactionDatatables;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Captain\CaptainServices;
use App\Services\Transaction\TransactionServices;
use App\Services\User\UserServices;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionDatatables $transactionDatatables,
        private readonly TransactionServices $transactionServices
    )
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->transactionDatatables->datatables($request);
        }
        return view("admin.pages.transactions.index")->with([
            "captains" => User::query()->where("is_captain", true)->select("id", "name")->get(),
            "clients" => User::query()->where("is_captain", false)->select("id", "name")->get(),
            "columns" => $this->transactionDatatables::columns(),
        ]);
    }

    public function show($id)
    {
        $transaction = $this->transactionServices->findById($id);
        return $this::sendSuccessResponse([
            "html" => view("admin.pages.transactions.show")->with(['transaction' => $transaction])->render()
        ]);
    }
}
