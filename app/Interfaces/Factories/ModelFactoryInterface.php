<?php

namespace App\Interfaces\Factories;

use App\Models\Country;

/**
 * Interface ModelFactoryInterface
 * @package App\Interfaces\Factories
 */
interface ModelFactoryInterface
{
    /**
     * @return Country
     */
    public function createCountry() : Country;

    /**
     * @return Customer
     */
    public function createCustomer() : Customer;
}
