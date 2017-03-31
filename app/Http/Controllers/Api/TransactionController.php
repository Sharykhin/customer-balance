<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WithdrawException;
use App\Http\Requests\TransactionRequest;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Interfaces\Repositories\TransactionRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Api
 */
class TransactionController
{
    /** @var CustomerRepositoryInterface $customerRepository */
    protected $customerRepository;

    /** @var TransactionRepositoryInterface $transactionRepository */
    protected $transactionRepository;

    /**
     * TransactionController constructor.
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

    /**
     * @param TransactionRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function deposit(TransactionRequest $request, $id) : JsonResponse
    {
        $customer = $this->customerRepository->get($id);

        $transaction = $this->transactionRepository->createDepositOperation($customer, floatval($request->request->get('amount')));

        return response()->created($transaction);
    }

    /**
     * @param TransactionRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function withdraw(TransactionRequest $request, $id) : JsonResponse
    {
        $customer = $this->customerRepository->get($id);

        try {
            $transaction = $this->transactionRepository->createWithdrawalOperation($customer, floatval($request->request->get('amount')));
            return response()->created($transaction);
        } catch (WithdrawException $e) {
            return response()->badRequest(['amount' => $e->getMessage()]);
        }
    }
}
