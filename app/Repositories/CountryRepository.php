<?php

namespace App\Repositories;

use App\Factories\CountryFactory;
use App\Interfaces\Repositories\CountryRepositoryInterface;
use App\Models\Country;

/**
 * Class CountryRepository
 * @package App\Repositories
 */
class CountryRepository implements CountryRepositoryInterface
{
    protected $countryFactory;

    public function __construct(
        CountryFactory $countryFactory
    )
    {
        $this->countryFactory = $countryFactory;
    }

    /**
     * @param $id
     * @return Country
     */
    public function getById($id)
    {
        return Country::find($id);
    }

    /**
     * @param array $parameters
     * @return Country
     */
    public function create(array $parameters) : Country
    {
        $country = $this->countryFactory->newCountry();
        $country->fill($parameters);
        $country->save();
        return $country;
    }

    public function getByCode(string $code)
    {
        return Country::where('code','=', $code)->get()->first();
    }
}
