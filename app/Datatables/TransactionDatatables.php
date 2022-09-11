<?php

namespace App\Datatables;

use App\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\Transaction;
use App\Support\DataTableActions;
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
                return (new DataTableActions())
                    ->show(route("admin.translation.show", $transaction->id))
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
            ->select("*");
    }
}
