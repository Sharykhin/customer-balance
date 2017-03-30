<?php

namespace App\Factories;

use App\Interfaces\Factories\CustomerFactoryInterface;
use App\Models\Customer;
use App\Models\CustomerBalance;

/**
 * Class CustomerFactory
 * @package App\Factories
 */
class CustomerFactory implements CustomerFactoryInterface
{
    /**
     * @return Customer
     *
     */
    public function newCustomer() : Customer
    {
        $customer = new Customer();
        $customer->bonus = rand(config('customer.bonus.min'), config('customer.bonus.max'));
        return $customer;
    }

    /**
     * @return CustomerBalance
     */
    public function newCustomerBalance() : CustomerBalance
    {
        $customerBalance = new CustomerBalance();
        $customerBalance->balance = 0;
        $customerBalance->bonus = 0;
    }
}
