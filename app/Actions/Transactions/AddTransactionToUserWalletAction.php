<?php

namespace App\Actions\Transactions;

use App\Enums\TransactionEnum;
use App\Models\User;
use Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use Str;

class AddTransactionToUserWalletAction
{
    use AsAction;

    public function handle(User $user, $amount, $notes = null): void
    {
        $user->transactions()->create([
            "transaction_code" => $user->id . Str::random(10),
            "transaction_type" => TransactionEnum::ADDING_MONEY_TO_WALLET,
            "price_amount" => $amount,
            "is_added_price" => true,
            "title" => [
                "en" => "Deposit money in user account",
                "ar" => "إيداع أموال فى حساب العميل"
            ],
            "notes" => $notes,
            "done_by" => Auth::user()->id,
        ]);

        $userCurrentWallet = $user->client_wallet;

        $user->update([
            "client_wallet" => $userCurrentWallet + $amount
        ]);

    }
}
