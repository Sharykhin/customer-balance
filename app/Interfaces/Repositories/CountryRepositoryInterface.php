<?php

namespace App\Interfaces\Repositories;

use App\Models\Country;

/**
 * Interface CountryRepositoryInterface
 * @package App\Interfaces\Repositories
 */
interface CountryRepositoryInterface
{
    public function getById($id);
}
