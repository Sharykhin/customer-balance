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

    /**
     * @param array $parameters
     * @return Customer
     */
    public function create(array $parameters) : Customer
    {
        $customer = $this->customerFactory->newCustomer();
        unset($parameters['country']);


        $customer->fill($parameters);
        $customer->save();
        $customer->balance()->save($customer->getBalance());
        return $customer;
    }

    /**
     * @param Customer $customer
     * @return Customer
     */
    public function save(Customer $customer) : Customer
    {
        $customer->save();
        return $customer;
    }
}