<?php

namespace App\Providers;

use App\Service\Country\DataSource\DataSource;
use App\Service\Country\DataSource\JsonDataSource;
use App\Service\Country\Parser\CountryDataParser;
use App\Service\Country\Parser\CountryDataParserService;
use App\Service\Country\Routing\CalculateCountryLandDistance;
use App\Service\Country\Routing\CalculateCountryLandDistanceService;
use App\Service\Country\RoutingAlgorithm\DijkstraRoutingAlgorithm;
use App\Service\Country\RoutingAlgorithm\RoutingAlgorithm;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CalculateCountryLandDistance::class, CalculateCountryLandDistanceService::class);
        $this->app->bind(CountryDataParser::class, CountryDataParserService::class);
        $this->app->bind(DataSource::class, JsonDataSource::class);
        $this->app->bind(RoutingAlgorithm::class, DijkstraRoutingAlgorithm::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
