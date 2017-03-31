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
    public function createDeposit(Customer $customer, int $amount) : Transaction
    {
        $result = DB::select("CALL make_transaction(" . $amount . ", 'USD', 'deposit', " . $customer->id . ")");
        dd($result);
    }
}