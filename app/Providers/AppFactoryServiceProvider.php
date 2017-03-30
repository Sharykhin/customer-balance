<?php

namespace App\Providers;

use App\Factories\CountryFactory;
use App\Factories\CustomerFactory;
use App\Interfaces\Factories\CountryFactoryInterface;
use App\Interfaces\Factories\CustomerFactoryInterface;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppFactoryServiceProvider
 * @package App\Providers
 */
class AppFactoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(CustomerFactoryInterface::class, CustomerFactory::class);
        $this->app->bind(CountryFactoryInterface::class, CountryFactory::class);
    }
}
