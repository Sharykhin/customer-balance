<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Interfaces\Repositories\TransactionRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class BalanceOperationController
 * @package App\Http\Controllers\Api
 */
class BalanceOperationController
{
    /** @var CustomerRepositoryInterface $customerRepository */
    protected $customerRepository;

    /** @var TransactionRepositoryInterface $transactionRepository */
    protected $transactionRepository;

    /**
     * BalanceOperationController constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        TransactionRepositoryInterface $transactionRepository
    )
    {
        $this->customerRepository = $customerRepository;
        $this->transactionRepository = $transactionRepository;
    }


    public function deposit($id) : JsonResponse
    {
        $customer = $this->customerRepository->get($id);

        $this->transactionRepository->createDeposit($customer, 10);
    }

}