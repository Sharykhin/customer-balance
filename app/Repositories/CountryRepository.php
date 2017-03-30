<?php

namespace App\Repositories;

use App\Interfaces\Factories\CountryFactoryInterface;
use App\Interfaces\Repositories\CountryRepositoryInterface;
use App\Models\Country;

/**
 * Class CountryRepository
 * @package App\Repositories
 */
class CountryRepository implements CountryRepositoryInterface
{
    /** @var CountryFactoryInterface $countryFactory */
    protected $countryFactory;

    /**
     * CountryRepository constructor.
     * @param CountryFactoryInterface $countryFactory
     */
    public function __construct(
        CountryFactoryInterface $countryFactory
    )
    {
        $this->countryFactory = $countryFactory;
    }

    /**
     * @param array $parameters
     * @return Country
     */
    public function create(array $parameters) : Country
    {
        $country = $this->countryFactory->newCountry();
        $country->fill(['code' => $parameters['country']]);
        $country->save();
        return $country;
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function getByCode(string $code)
    {
        return Country::where('code','=', $code)->first();
    }
}
