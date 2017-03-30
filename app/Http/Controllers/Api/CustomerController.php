<?php

namespace App\Http\Controllers\Api;

use App\Factories\CustomerFactory;
use App\Http\Requests\CustomerRequest;
use App\Repositories\CustomerRepository;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Api
 */
class CustomerController
{
    protected $customerRepository;

    public function __construct()
    {

    }

    public function index()
    {
        return response()->success(['user'=>1]);
    }

    public function create(CustomerRequest $request, CustomerRepository $customerRepository)
    {
        $customer = $customerRepository->create($request->request->all());
        return response()->success($customer);
    }
}
