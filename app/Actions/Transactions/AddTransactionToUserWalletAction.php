<?php

namespace App\Actions\Transactions;

use App\Enums\TransactionEnum;
use App\Models\Transaction;
use App\Models\User;
use Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use Str;

class AddTransactionToUserWalletAction
{
    use AsAction;

    public function handle(User $user, $amount, $notes = null, $accountType = "user"): void
    {
        $user_id = null;
        $captain_id = null;
        $title = [];

        if ($accountType == "user") {
            $user_id = $user->id;
            $title = [
                "en" => "Deposit money in user account",
                "ar" => "إيداع أموال فى حساب العميل"
            ];
        }

        if ($accountType == "captain") {
            $captain_id = $user->id;
            $title = [
                "en" => "Deposit money in captain account",
                "ar" => "إيداع أموال فى حساب الكابتن"
            ];
        }

        Transaction::query()->create([
            "transaction_code" => Str::random(10),
            "transaction_type" => TransactionEnum::ADDING_MONEY_TO_WALLET,
            "price_amount" => $amount,
            "user_id" => $user_id,
            "captain_id" => $captain_id,
            "is_added_price" => true,
            "title" => $title,
            "notes" => $notes,
            "done_by" => Auth::user()->id,
        ]);

        if ($accountType == "user") {

            $this->updateClientWallet($user, $amount);

        } else {

            $this->updateCaptainWallet($user, $amount);

        }

    }

    private function updateClientWallet(User $user, float $amount): void
    {
        $userCurrentWallet = $user->client_wallet;

        $user->update([
            "client_wallet" => $userCurrentWallet + $amount
        ]);

    }

    private function updateCaptainWallet(User $user, float $amount): void
    {
        $captainCurrentWallet = $user->captain_wallet;

        $user->update([
            "captain_wallet" => $captainCurrentWallet + $amount
        ]);

    }

}
