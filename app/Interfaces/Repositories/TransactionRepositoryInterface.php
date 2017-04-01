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
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function all(int $limit, int $offset = 0);

    /**
     * @return int
     */
    public function count() : int;

    /**
     * @param Customer $customer
     * @param float $amount
     * @return Transaction
     */
    public function createDepositOperation(Customer $customer, float $amount) : Transaction;

    /**
     * @param Customer $customer
     * @param float $amount
     * @return Transaction
     */
    public function createWithdrawalOperation(Customer $customer, float $amount) : Transaction;
}