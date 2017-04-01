<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\WithdrawException;
use App\Http\Requests\TransactionRequest;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Interfaces\Repositories\TransactionRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Api
 */
class TransactionController
{
    const LIMIT = 10;

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
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        $limit = $request->query->get('limit') ?: self::LIMIT;
        $offset = $request->query->get('offset') ?: 0;

        $transactions = $this->transactionRepository->all($limit, $offset);
        $total = $this->transactionRepository->count();
        $count = sizeof($transactions);
        return response()->success($transactions, compact('total', 'count', 'limit', 'offset'));
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
