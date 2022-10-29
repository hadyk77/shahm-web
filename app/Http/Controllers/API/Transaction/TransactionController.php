<?php

namespace App\Http\Controllers\API\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::query()->where("captain_id", \Auth::id())->latest()->get();
        return $this::sendSuccessResponse(TransactionResource::collection($transactions));
    }

    public function show($id)
    {
        $transaction = Transaction::query()->where("captain_id", \Auth::id())->latest()->findOrFail($id);
        return $this::sendSuccessResponse(TransactionResource::make($transaction));
    }
}
