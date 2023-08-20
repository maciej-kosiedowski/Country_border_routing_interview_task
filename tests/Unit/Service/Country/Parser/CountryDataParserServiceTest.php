<?php

declare(strict_types=1);

namespace Tests\Unit\Service\Country\Parser;

use App\Service\Country\DataSource\DataSource;
use App\Service\Country\Parser\CountryDataParser;
use JsonException;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CountryDataParserServiceTest extends TestCase
{
    /**
     * @var CountryDataParser
     */
    private CountryDataParser $countryDataParser;

    /**
     * @return void
     * @throws JsonException
     */
    public function testGetCca3(): void
    {
        $this->assertEquals(['ABW', 'AFG', 'AGO', 'AIA', 'ALA', 'ALB', 'AND'], $this->countryDataParser->getCca3());
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function testGetCountryAndBorders(): void
    {
        $this->assertEquals([
            'ABW' => [],
            'AFG' => ['IRN', 'PAK', 'TKM', 'UZB', 'TJK', 'CHN'],
            'AGO' => ['COG', 'COD', 'ZMB', 'NAM'],
            'AIA' => [],
            'ALA' => [],
            'ALB' => ['MNE', 'GRC', 'MKD', 'UNK'],
            'AND' => ['FRA', 'ESP'],
        ], $this->countryDataParser->getCountryAndBorders());
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function testGetLatitudeAndLongitude(): void
    {
        $this->assertEquals([
            'ABW' => [
                'latitude' => 12.5,
                'longitude' => -69.96666666,
            ],
            'AFG' => [
                'latitude' => 33,
                'longitude' => 65,
            ],
            'AGO' => [
                'latitude' => -12.5,
                'longitude' => 18.5,
            ],

            'AIA' => [
                'latitude' => 18.25,
                'longitude' => -63.16666666,
            ],
            'ALA' => [
                'latitude' => 60.116667,
                'longitude' => 19.9,
            ],
            'ALB' => [
                'latitude' => 41,
                'longitude' => 20,
            ],
            'AND' => [
                'latitude' => 42.5,
                'longitude' => 1.5,
            ],
        ], $this->countryDataParser->getLatitudeAndLongitude());
    }

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->instance(
            DataSource::class,
            Mockery::mock(DataSource::class, function (MockInterface $mock) {
                $mock->shouldReceive('getData')->andReturns(
                    json_decode(
                        file_get_contents(base_path('tests/Unit/Service/__fixture/countries.json')),
                        true,
                        512,
                        JSON_THROW_ON_ERROR
                    )
                )->once();
            })
        );
        $this->countryDataParser = app(CountryDataParser::class);
    }
}
