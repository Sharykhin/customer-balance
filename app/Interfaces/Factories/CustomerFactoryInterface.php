<?php

namespace App\Interfaces\Factories;

use App\Models\Customer;

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
}
