<?php

namespace App\Interfaces\Repositories;

use App\Models\Country;

/**
 * Interface CountryRepositoryInterface
 * @package App\Interfaces\Repositories
 */
interface CountryRepositoryInterface
{
    /**
     * @param string $code
     * @return Country|null
     */
    public function getByCode(string $code);

    /**
     * @param array $parameters
     * @return Country
     */
    public function create(array $parameters) : Country;
}
