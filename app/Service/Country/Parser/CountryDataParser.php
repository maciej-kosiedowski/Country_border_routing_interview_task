<?php

declare(strict_types=1);

namespace App\Service\Country\Parser;

use JsonException;

interface CountryDataParser
{
    /**
     * @return array<int, string>
     *
     * @throws JsonException
     */
    public function getCca3(): array;

    /**
     * @return array<string, array<string>>
     *
     * @throws JsonException
     */
    public function getCountryAndBorders(): array;

    /**
     * @return array<string, array<string, array<int, float>>>
     *
     * @throws JsonException
     */
    public function getDijkstraGraph(): array;

    /**
     * @return array<string, array<int, float>>
     *
     * @throws JsonException
     */
    public function getLatitudeAndLongitude(): array;
}
