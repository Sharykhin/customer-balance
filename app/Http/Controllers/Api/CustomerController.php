<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerRequest;
use App\Interfaces\Repositories\CustomerBalanceRepositoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use DB;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Api
 */
class CustomerController
{
    const LIMIT = 10;

    /** @var CustomerRepositoryInterface $customerRepository */
    protected $customerRepository;

    /**
     * CustomerController constructor.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        $limit = (int) $request->query->get('limit') ?: self::LIMIT;
        $offset = (int) $request->query->get('offset') ?: 0;

        $customers = $this->customerRepository->all($limit, $offset);
        $total = $this->customerRepository->count();
        $count = sizeof($customers);
        return response()->success($customers, compact('total', 'count', 'limit', 'offset'));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id) : JsonResponse
    {
        $customer = $this->customerRepository->getWithBalance($id);
        return response()->success($customer);
    }

    /**
     * @param CustomerRequest $request
     * @param CustomerBalanceRepositoryInterface $customerBalanceRepository
     * @return JsonResponse
     */
    public function create(
        CustomerRequest $request,
        CustomerBalanceRepositoryInterface $customerBalanceRepository
    ) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $parameters = $request->request->all();
            $customer = $this->customerRepository->create($parameters);
            $customerBalanceRepository->create($customer);
            DB::commit();
            return response()->created($customer);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->error($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param CustomerRequest $request
     * @return JsonResponse
     */
    public function update($id, CustomerRequest $request) : JsonResponse
    {
        $customer = $this->customerRepository->get($id);
        $parameters = $request->except('bonus');
        $customer = $this->customerRepository->update($customer, $parameters);
        return response()->success($customer);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id) : JsonResponse
    {
        $customer = $this->customerRepository->get($id);
        // TODO: detect active transactions
        if ($this->customerRepository->remove($customer)) {
            return response()->successRemove();
        }
    }
}
