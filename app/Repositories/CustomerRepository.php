<?php

namespace App\Repositories;

use App\Factories\CustomerFactory;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Models\Country;
use App\Models\Customer;

/**
 * Class CustomerRepository
 * @package App\Repositories
 */
class CustomerRepository implements CustomerRepositoryInterface
{
    protected $customerFactory;

    protected $countryRepository;

    public function __construct(CustomerFactory $customerFactory, CountryRepository $countryRepository)
    {
        $this->customerFactory = $customerFactory;
        $this->countryRepository = $countryRepository;
    }

    /**
     * @param array $parameters
     * @return Customer
     */
    public function create(array $parameters) : Customer
    {
        $customer = $this->customerFactory->newCustomer();
        if (isset($parameters['country'])) {
           $country = $this->countryRepository->getByCode($parameters['country']);

           if (!$country instanceof Country) {
               $country = $this->countryRepository->create(['code' => $parameters['country']]);
           }
           unset($parameters['country']);
           $customer->country_id = $country->id;
        }
        $customer->fill($parameters);
        $customer->save();
        return $customer;
    }

    public function save(Customer $customer) : Customer
    {
        $customer->save();
        return $customer;
    }
}