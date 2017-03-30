<?php

namespace App\Factories;

use App\Interfaces\Factories\ModelFactoryInterface;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerBalance;

/**
 * Class ModelFactory
 * @package App\Factories
 */
class ModelFactory implements ModelFactoryInterface
{
    public function createCountry() : Country
    {
        $country = new Country();
        return $country;
    }

    public function createCustomer() : Customer
    {
        $customer = new Customer();
        $customer->bonus = rand(config('customer.bonus.min'), config('customer.bonus.max'));

        $customerBalance = new CustomerBalance();
        $customerBalance->balance = 0;
        $customerBalance->bonus = 0;
        $customerBalance->customer()->associate($customer);

        return $customer;
    }
}