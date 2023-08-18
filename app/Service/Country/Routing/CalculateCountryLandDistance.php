<?php

declare(strict_types=1);

namespace App\Service\Country\Routing;

interface CalculateCountryLandDistance
{
    public function handle(string $origin, string $destination): ?array;
}
