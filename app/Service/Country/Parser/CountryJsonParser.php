<?php

declare(strict_types=1);

namespace App\Service\Country\Parser;

interface CountryJsonParser
{
    public function getCca3(): array;

    public function getCountryAndBorders(): array;
}
