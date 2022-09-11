<?php

namespace App\Actions\Transactions;

use App\Enums\TransactionEnum;
use App\Models\User;
use Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class AddTransactionToUserWalletAction
{
    use AsAction;

    public function handle(User $user, $amount, $notes = null): void
    {
        $user->transactions()->create([
            "transaction_type" => TransactionEnum::ADDING_MONEY_TO_WALLET,
            "price_amount" => $amount,
            "is_added_price" => true,
            "title" => [
                "ar" => "Deposit money in user account",
                "en" => "إيداع أموال فى حساب العميل"
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
