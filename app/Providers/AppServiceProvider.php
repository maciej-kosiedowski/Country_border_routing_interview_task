<?php

namespace App\Providers;

use App\Service\Country\Routing\CalculateCountryLandDistance;
use App\Service\Country\Routing\CalculateCountryLandDistanceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CalculateCountryLandDistance::class, CalculateCountryLandDistanceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
