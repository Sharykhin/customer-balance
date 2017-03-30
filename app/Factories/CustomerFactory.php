<?php

namespace App\Factories;

use App\Models\Customer;
use App\Models\CustomerBalance;

/**
 * Class CustomerFactory
 * @package App\Factories
 */
class CustomerFactory
{
    public function newCustomer() : Customer
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