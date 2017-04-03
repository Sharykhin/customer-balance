<?php

namespace App\Repositories;

use App\Exceptions\WithdrawException;
use App\Interfaces\Factories\TransactionFactoryInterface;
use App\Interfaces\Repositories\TransactionRepositoryInterface;
use App\Models\Customer;
use App\Models\Transaction;
use DB;
use Illuminate\Database\QueryException;

/**
 * Class TransactionRepository
 * @package App\Repositories
 */
class TransactionRepository implements TransactionRepositoryInterface
{
    /** @var TransactionFactoryInterface $transactionFactory */
    protected $transactionFactory;

    /**
     * TransactionRepository constructor.
     * @param TransactionFactoryInterface $transactionFactory
     */
    public function __construct(
        TransactionFactoryInterface $transactionFactory
    )
    {
        $this->transactionFactory = $transactionFactory;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function all(int $limit, int $offset = 0)
    {
        return Transaction::offset($offset)->limit($limit)->get();
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return Transaction::count();
    }

    /**
     * @param Customer $customer
     * @param float $amount
     * @return Transaction
     */
    public function createDepositOperation(Customer $customer, float $amount) : Transaction
    {
        $result = DB::select("CALL make_transaction(" . $amount . ", 'USD', 'deposit', " . $customer->id . ")");

        $transaction = $this->transactionFactory->newTransaction();
        $transaction->fill((array) $result[0]);
        return $transaction;
    }

    /**
     * @param Customer $customer
     * @param float $amount
     * @return Transaction
     * @throws WithdrawException
     */
    public function createWithdrawalOperation(Customer $customer, float $amount) : Transaction
    {
        try {
            $result = DB::select("CALL make_transaction(" . $amount . ", 'USD', 'withdrawal', " . $customer->id . ")");
            $transaction = $this->transactionFactory->newTransaction();
            $transaction->fill((array) $result[0]);
            return $transaction;
        } catch (QueryException $e) {
            if ($e->getCode() === '45000') {
                throw new WithdrawException($e->getPrevious()->errorInfo[2]);
            }
        }
    }
}