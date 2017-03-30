<?php

namespace App\Repositories;

use App\Interfaces\Factories\CustomerFactoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;
use Exception;
use DB;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
class CustomerRepository implements CustomerRepositoryInterface
{
    /** @var CustomerFactoryInterface $customerFactory */
    protected $customerFactory;

    /**
     * CustomerRepository constructor.
     * @param CustomerFactoryInterface $customerFactory
     */
    public function __construct(
        CustomerFactoryInterface $customerFactory
    )
    {
        $this->customerFactory = $customerFactory;
    }

    /**
     * @param array $parameters
     * @return Customer
     * @throws Exception
     */
    public function create(array $parameters) : Customer
    {
        $customer = $this->customerFactory->newCustomer();
        $customerBalance = $this->customerFactory->newCustomerBalance();
        $customerBalance->customer()->associate($customer);

        $customer->fill($parameters);
        try {
            DB::beginTransaction();
            $customer->save();
            $customer->balance()->save($customerBalance);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }

        return $customer;
    }
}