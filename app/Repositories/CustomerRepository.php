<?php

namespace App\Repositories;

use App\Interfaces\Factories\CustomerFactoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;

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

    public function all(int $limit = null, int $offset = 0)
    {

    }

    /**
     * @param array $parameters
     * @return Customer
     * @throws Exception
     */
    public function create(array $parameters) : Customer
    {
        $customer = $this->customerFactory->newCustomer();
        $customer->fill($parameters);
        $customer->save();
        return $customer;
    }
}