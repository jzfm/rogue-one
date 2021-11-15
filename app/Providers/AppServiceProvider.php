<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Rogue\AreaCalculator\Area\Application\Repositories\TestRepository;
use Rogue\AreaCalculator\Area\Application\Repositories\TestRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindRepositories();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function bindRepositories(): void
    {
        $this->app->bind(
            TestRepositoryInterface::class,
            TestRepository::class
        );
    }
}
