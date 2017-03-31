<?php

namespace App\Repositories;

use App\Interfaces\Repositories\TransactionRepositoryInterface;
use App\Models\Customer;
use App\Models\Transaction;
use DB;

/**
 * Class TransactionRepository
 * @package App\Repositories
 */
class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * @param Customer $customer
     * @param float $amount
     * @return Transaction
     */
    public function createDepositOperation(Customer $customer, float $amount) : Transaction
    {
        $result = DB::select("CALL make_transaction(" . $amount . ", 'USD', 'deposit', " . $customer->id . ")");
        dd($result);
    }

    public function createWithdrawalOperation(Customer $customer, float $amount) : Transaction
    {

    }
}