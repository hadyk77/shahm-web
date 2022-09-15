<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\Transaction;
use App\Support\DataTableActions;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            "transaction_code" => ["transaction_code"],
            "title" => ['title->ar'],
            "price_amount" => ["price_amount"],
            "notes" => ["notes"],
            "done_by" => ['admin.name'],
            "created_at",
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn("created_at", function (Transaction $transaction) {
                return Helper::formatDate($transaction->created_at);
            })
            ->addColumn("notes", function (Transaction $transaction) {
                return $transaction->notes ?? "-----";
            })
            ->addColumn("done_by", function (Transaction $transaction) {
                return $transaction->admin?->name ?? "-----";
            })
            ->addColumn("price_amount", function (Transaction $transaction) {
                $html = "";
                if ($transaction->is_added_price == 1) {
                    $html .= '<span class="svg-icon svg-icon-primary svg-icon-2x">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor"></rect>
                                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                                </svg>
                            </span>';
                }
                if ($transaction->is_added_price == 0) {
                    $html .= '<span class="svg-icon svg-icon-danger svg-icon-2x">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor"></rect>
                                </svg>
                            </span>';
                }
                $html .= " " . Helper::price($transaction->price_amount);
                return $html;
            })
            ->addColumn("action", function (Transaction $transaction) {
                $html = '<a class="btn btn-icon btn-bg-light btn-sm btn-active-color-primary me-1 transactionModal" href="javascript:;" data-url="' . route("admin.transactions.show", $transaction->id) . '">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-icon">
                                    <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="currentColor"></path>
                                    <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="currentColor" opacity="0.3"></path>
                                    </g>
                                </svg>
                            </span>
                        </a>';
                return (new DataTableActions())
                    ->button($html)
                    ->make();
            })
            ->rawColumns(["action", "price_amount"])
            ->make();
    }

    public function query(Request $request)
    {
        return Transaction::query()
            ->with(["admin"])
            ->latest("transactions.created_at")
            ->when($request->filled("client_id") && $request->client_id != "", function ($query) {
                return $query->where('user_id', request()->client_id);
            })
            ->when($request->filled("captain_id") && $request->captain_id != "", function ($query) {
                return $query->where('captain_id', request()->captain_id);
            })
            ->when($request->filled("txn_code") && $request->txn_code != "", function ($query) {
                return $query->where('transaction_code', "LIKE", "%" . request()->txn_code . "%");
            })
            ->when($request->filled("date_range") && $request->date_range != "", function ($query) {
                $date = explode("/", request()->date_range);
                $startDate = Carbon::parse(trim($date[0]))->startOfDay()->format("Y-m-d H:i:s");
                $endDate = Carbon::parse(trim($date[1]))->endOfDay()->format("Y-m-d H:i:s");
                $query->whereBetween("created_at", [$startDate, $endDate]);
            })
            ->select("*");
    }
}
