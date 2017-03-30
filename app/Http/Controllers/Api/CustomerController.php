<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerRequest;
use App\Interfaces\Repositories\CountryRepositoryInterface;
use App\Interfaces\Repositories\CustomerBalanceRepositoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Models\Country;
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
        $count = $this->customerRepository->count();
        return response()->success($customers, [
            'total' => $count,
            'count' => sizeof($customers),
            'limit' => $limit,
            'offset' => $offset
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id) : JsonResponse
    {
        $customer = $this->customerRepository->get($id);
        return response()->success($customer);
    }

    /**
     * @param CustomerRequest $request
     * @param CustomerBalanceRepositoryInterface $customerBalanceRepository
     * @param CountryRepositoryInterface $countryRepository
     * @return JsonResponse
     */
    public function create(
        CustomerRequest $request,
        CustomerBalanceRepositoryInterface $customerBalanceRepository,
        CountryRepositoryInterface $countryRepository
    ) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $country = $countryRepository->getByCode($request->request->get('country'));
            if (!$country instanceof Country) {
                $country = $countryRepository->create($request->only('country'));
            }
            $parameters = $request->except('country') + ['country_id' => $country->id];
            $customer = $this->customerRepository->create($parameters);
            $customerBalanceRepository->create($customer);
            DB::commit();
            $customer->country = $country;
            return response()->created($customer);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->error($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param CustomerRequest $request
     * @param CountryRepositoryInterface $countryRepository
     * @return JsonResponse
     */
    public function update(
        $id,
        CustomerRequest $request,
        CountryRepositoryInterface $countryRepository
    ) : JsonResponse
    {
        $customer = $this->customerRepository->get($id);
        $parameters = $request->except('bonus');
        $country = null;
        if ($request->request->has('country')) {
            $country = $countryRepository->getByCode($request->request->get('country'));
            if (!$country instanceof Country) {
                $country = $countryRepository->create($request->only('country'));
            }
            $parameters['country_id'] = $country->id;
        }

        $customer = $this->customerRepository->update($customer, $parameters);
        $customer['country'] = !is_null($country) ?: $customer['country'];
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
