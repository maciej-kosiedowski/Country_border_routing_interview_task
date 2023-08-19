<?php

declare(strict_types=1);

namespace App\Service\Country\Parser;

use App\Service\Country\DataSource\DataSource;
use Illuminate\Support\Arr;
use JsonException;

class CountryDataParserService implements CountryDataParser
{
    private array $data = [];

    public function __construct(private readonly DataSource $dataSource)
    {
    }

    /**
     * Added cache mechanism to store country data in memory
     *
     * @throws JsonException
     */
    private function readCountryData(): array
    {
        if ($this->data === []) {
            $this->data = $this->dataSource->getData();
        }

        return $this->data;
    }

    /**
     * {@inheritdoc}
     */
    public function getCca3(): array
    {
        return Arr::pluck($this->readCountryData(), 'cca3');
    }

    /**
     * {@inheritdoc}
     */
    public function getCountryAndBorders(): array
    {
        return Arr::pluck($this->readCountryData(), 'borders', 'cca3');
    }

    /**
     * {@inheritdoc}
     */
    public function getLatitudeAndLongitude(): array
    {
        return Arr::map(
            Arr::pluck($this->readCountryData(), 'latlng', 'cca3'),
            static fn ($latLng) => ['latitude' => $latLng[0], 'longitude' => $latLng[1]]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDijkstraGraph(): array
    {
        $latLng = $this->getLatitudeAndLongitude();

        return Arr::map(
            array_filter($this->getCountryAndBorders()),
            static fn ($borders) => Arr::mapWithKeys($borders, static fn (string $value) => [$value => $latLng[$value]])
        );
    }
}
