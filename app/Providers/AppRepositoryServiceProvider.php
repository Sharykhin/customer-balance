<?php

namespace App\Providers;

use App\Interfaces\Repositories\CustomerBalanceRepositoryInterface;
use App\Interfaces\Repositories\CustomerRepositoryInterface;
use App\Interfaces\Repositories\TransactionRepositoryInterface;
use App\Repositories\CustomerBalanceRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\TransactionRepository;
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
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }
}
