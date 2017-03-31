<?php

namespace App\Repositories;

use App\Interfaces\Factories\CustomerFactoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @param int|null $limit
     * @param int $offset
     * @return mixed
     */
    public function all(int $limit, int $offset = 0)
    {
        return Customer::offset($offset)->limit($limit)->get();
    }

    /**
     * @return int
     */
    public function count() : int
    {
        return Customer::count();
    }

    /**
     * @param $id
     * @return Customer
     */
    public function get($id) : Customer
    {
        $customer = Customer::find($id);
        if (!$customer instanceof Customer) {
            throw new ModelNotFoundException('Customer could not be found');
        }

        return $customer;
    }

    /**
     * @param Customer $customer
     * @return bool|null
     */
    public function remove(Customer $customer) : bool
    {
        return $customer->delete();
    }

    /**
     * @param array $parameters
     * @return Customer
     * @throws Exception
     */
    public function create(array $parameters) : Customer
    {
        $customer = $this->customerFactory->newCustomer();
        $customer->fill($parameters);
        $customer->save();
        return $customer;
    }

    /**
     * @param Customer $customer
     * @param array $parameters
     * @return Customer
     */
    public function update(Customer $customer, array $parameters) : Customer
    {
        $customer->update($parameters);
        return $customer;
    }
}