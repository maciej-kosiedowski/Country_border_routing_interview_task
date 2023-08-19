<?php declare(strict_types = 1);

namespace Tests\Unit\Service\Country\Routing;

use App\Service\Country\Parser\CountryDataParser;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CalculateCountryLandDistanceServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->instance(
            CountryDataParser::class,
            Mockery::mock(CountryDataParser::class, function (MockInterface $mock) {
                $mock->shouldReceive('getLatitudeAndLongitude')->andReturns([

                ])->once();
            })
        );
    }
}
