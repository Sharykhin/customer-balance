<?php

namespace App\Interfaces\Repositories;

use App\Models\Customer;
use App\Models\Transaction;

/**
 * Interface TransactionRepositoryInterface
 * @package App\Interfaces\Repositories
 */
interface TransactionRepositoryInterface
{
    /**
     * @param Customer $customer
     * @param int $amount
     * @return Transaction
     */
    public function createDeposit(Customer $customer, int $amount) : Transaction;
}