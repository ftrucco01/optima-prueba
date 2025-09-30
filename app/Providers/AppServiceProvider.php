<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private array $bindingInterfaces = [
        \OptimaCultura\Company\Domain\CompanyRepositoryInterface::class =>
            \OptimaCultura\Company\Infrastructure\CompanyRepositoryEloquent::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->bindingInterfaces as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
