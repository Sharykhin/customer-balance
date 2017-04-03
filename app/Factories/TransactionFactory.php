<?php

namespace App\Factories;

use App\Interfaces\Factories\TransactionFactoryInterface;
use App\Models\Transaction;

/**
 * Class TransactionFactory
 * @package App\Factories
 */
class TransactionFactory implements TransactionFactoryInterface
{
    /**
     * @return Transaction
     */
    public function newTransaction() : Transaction
    {
        $transaction = new Transaction();
        return $transaction;
    }
}
