<?php

namespace App\Providers;

use App\Interfaces\Repositories\CustomerBalanceRepositoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Repositories\CustomerBalanceRepository;
use App\Repositories\CustomerRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppFactoryServiceProvider
 * @package App\Providers
 */
class AppRepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(CustomerBalanceRepositoryInterface::class, CustomerBalanceRepository::class);
    }
}
