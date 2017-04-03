<?php

namespace App\Interfaces\Factories;

use App\Models\Transaction;

/**
 * Interface TransactionFactoryInterface
 * @package App\Interfaces\Factories
 */
interface TransactionFactoryInterface
{
    /**
     * @return Transaction
     */
    public function newTransaction() : Transaction;
}
