<?php

declare(strict_types=1);

namespace App\Service\Country\Routing;

use JsonException;

interface CalculateCountryLandDistance
{
    /**
     * @return array<int,string>|null
     *
     * @throws JsonException
     */
    public function handle(string $origin, string $destination): ?array;
}
