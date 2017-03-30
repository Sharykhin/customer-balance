<?php

namespace App\Factories;

use App\Models\Country;

class CountryFactory
{
    public function newCountry() : Country
    {
        return new Country();
    }
}