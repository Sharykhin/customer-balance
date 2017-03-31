<?php

namespace App\Providers;

use App\Factories\CustomerFactory;
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
    }
}
