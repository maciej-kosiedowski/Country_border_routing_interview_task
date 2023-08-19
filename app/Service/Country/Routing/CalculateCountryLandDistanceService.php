<?php

declare(strict_types=1);

namespace App\Service\Country\Routing;

use App\Service\Country\Parser\CountryDataParser;
use App\Service\Country\RoutingAlgorithm\RoutingAlgorithm;

class CalculateCountryLandDistanceService implements CalculateCountryLandDistance
{
    public function __construct(
        private readonly CountryDataParser $countryDataParser,
        private readonly RoutingAlgorithm $routingAlgorithm
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function handle(string $origin, string $destination): ?array
    {
        $origin = strtoupper($origin);
        $destination = strtoupper($destination);

        if ($origin === $destination) {
            return [$origin, $destination];
        }

        $borders = $this->countryDataParser->getCountryAndBorders();

        // Country don`t has any land border, country list reduced to 165 countries
        $borders = array_filter($borders);
        if (! isset($borders[$origin])) {
            return null;
        }
        // Check if is not direct neighborhood
        if (array_key_exists($destination, array_flip($borders[$origin]))) {
            return [$origin, $destination];
        }

        $latitudeAndLongitude = $this->countryDataParser->getLatitudeAndLongitude();

        // If simple checks was not successful use routingAlgorithm to calculate the shortest country path
        return $this->routingAlgorithm->calculateRoute(
            $this->countryDataParser->getDijkstraGraph(),
            $origin,
            $destination,
            $latitudeAndLongitude[$origin],
            $latitudeAndLongitude[$destination],
        );
    }
}
