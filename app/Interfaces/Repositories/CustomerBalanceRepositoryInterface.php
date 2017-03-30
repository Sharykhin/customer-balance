<?php

namespace App\Interfaces\Repositories;

use App\Models\Customer;
use App\Models\CustomerBalance;

/**
 * Interface CustomerBalanceRepositoryInterface
 * @package App\Interfaces\Repositories
 */
interface CustomerBalanceRepositoryInterface
{
    /**
     * @param Customer $customer
     * @param array $parameters
     * @return CustomerBalance
     */
    public function create(Customer $customer, array $parameters = []) : CustomerBalance;
}