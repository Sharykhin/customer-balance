<?php

namespace App\Interfaces\Repositories;

use App\Models\Customer;
use App\Models\CustomerView;

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
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function all(int $limit, int $offset = 0);

    /**
     * @param $id
     * @return Customer
     */
    public function get($id) : Customer;

    /**
     * @param $id
     * @return CustomerView
     */
    public function getWithBalance($id) : CustomerView;

    /**
     * @return int
     */
    public function count() : int;

    /**
     * @param Customer $customer
     * @return bool
     */
    public function remove(Customer $customer) : bool;

    /**
     * @param Customer $customer
     * @param array $parameters
     * @return Customer
     */
    public function update(Customer $customer, array $parameters) : Customer;
}
