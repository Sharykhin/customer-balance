<?php

namespace App\Interfaces\Factories;

use App\Models\Customer;
use App\Models\CustomerBalance;

/**
 * Interface CustomerFactoryInterface
 * @package App\Interfaces\Factories
 */
interface CustomerFactoryInterface
{
    /**
     * @return Customer
     */
    public function newCustomer() : Customer;

    /**
     * @return CustomerBalance
     */
    public function newCustomerBalance() : CustomerBalance;
}
