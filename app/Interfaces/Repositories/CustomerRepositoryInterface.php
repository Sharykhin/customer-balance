<?php

namespace App\Interfaces\Repositories;

use App\Models\Customer;

/**
 * Interface CustomerRepositoryInterface
 * @package App\Interfaces\Repositories
 */
interface CustomerRepositoryInterface
{
    /**
     * @param array $parameters
     * @return Customer
     */
    public function create(array $parameters) : Customer;

    /**
     * @param Customer $customer
     * @return Customer
     */
    public function save(Customer $customer) : Customer;
}
