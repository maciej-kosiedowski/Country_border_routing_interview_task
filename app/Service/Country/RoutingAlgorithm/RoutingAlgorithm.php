<?php

declare(strict_types=1);

namespace App\Service\Country\RoutingAlgorithm;

interface RoutingAlgorithm
{
    /**
     * @return array<int, string>
     */
    public function calculateRoute(array $graph, string $start, string $end, array $startLatLng, array $endLatLng): array;
}
