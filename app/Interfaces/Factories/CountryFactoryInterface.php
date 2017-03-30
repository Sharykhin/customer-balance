<?php

namespace App\Interfaces\Factories;

use App\Models\Country;

/**
 * Interface CountryFactoryInterface
 * @package App\Interfaces\Factories
 */
interface CountryFactoryInterface
{
    /**
     * @return Country
     */
    public function newCountry() : Country;
}