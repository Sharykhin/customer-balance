<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerRequest;
use App\Interfaces\Repositories\CustomerBalanceRepositoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use DB;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Api
 */
class CustomerController
{
    /** @var CustomerRepositoryInterface $customerRepository */
    protected $customerRepository;

    /**
     * CustomerController constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        return response()->success(['user'=>1]);
    }

    /**
     * @param CustomerRequest $request
     * @param CustomerBalanceRepositoryInterface $customerBalanceRepository
     * @return JsonResponse
     */
    public function create(CustomerRequest $request, CustomerBalanceRepositoryInterface $customerBalanceRepository) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $customer = $this->customerRepository->create($request->request->all());
            $customerBalanceRepository->create($customer);
            DB::commit();
            return response()->created($customer);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->error($e->getMessage());
        }
    }
}
