<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Datatables\TransactionDatatables;
use App\Http\Controllers\Controller;
use App\Services\Transaction\TransactionServices;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(private readonly TransactionDatatables $transactionDatatables, private readonly TransactionServices $transactionServices)
    {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->transactionDatatables->datatables($request);
        }
        return view("admin.pages.transactions.index")->with([
            "columns" => $this->transactionDatatables::columns(),
        ]);
    }
}
