<?php

namespace App\Factories;

use App\Interfaces\Factories\CountryFactoryInterface;
use App\Models\Country;

/**
 * Class CountryFactory
 * @package App\Factories
 */
class CountryFactory implements CountryFactoryInterface
{
    /**
     * @return Country
     */
    public function newCountry() : Country
    {
        return new Country();
    }
}
