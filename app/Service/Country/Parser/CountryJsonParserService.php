<?php

declare(strict_types=1);

namespace App\Service\Country\Parser;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use JsonException;

class CountryJsonParserService implements CountryJsonParser
{
    private string $countryJsonFile;

    private array $data = [];

    public function __construct()
    {
        $this->countryJsonFile = storage_path('app/countries.json');
    }

    /**
     * Added cache mechanism to store country data in memory
     *
     * @throws JsonException
     */
    private function readCountryData(): array
    {
        if ($this->data === []) {
            $this->data = json_decode(File::get($this->countryJsonFile), true, 512, JSON_THROW_ON_ERROR);
        }

        return $this->data;
    }

    /**
     * @return array<int, string>
     *
     * @throws JsonException
     */
    public function getCca3(): array
    {
        return Arr::pluck($this->readCountryData(), 'cca3');
    }

    /**
     * @return array<string, array<string>>
     *
     * @throws JsonException
     */
    public function getCountryAndBorders(): array
    {
        return Arr::pluck($this->readCountryData(), 'borders', 'cca3');
    }
}
