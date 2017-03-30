<?php

namespace App\Handlers;

use App\Interfaces\Repositories\CustomerBalanceRepositoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;
use DB;
use Exception;

/**
 * Class CustomerHandler
 * @package App\Handlers
 */
class CustomerHandler
{
    /** @var CustomerRepositoryInterface $customerRepository */
    protected $customerRepository;

    /** @var CustomerBalanceRepositoryInterface $customerBalanceRepository */
    protected $customerBalanceRepository;

    /***
     * CustomerHandler constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param CustomerBalanceRepositoryInterface $customerBalanceRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        CustomerBalanceRepositoryInterface $customerBalanceRepository
    )
    {
        $this->customerRepository = $customerRepository;
        $this->customerBalanceRepository = $customerBalanceRepository;
    }

    public function create(array $parameters) : Customer
    {
        try {
            DB::beginTransaction();
            $customer = $this->customerRepository->create($parameters);
            $this->customerBalanceRepository->create($customer);
            return $customer;
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}