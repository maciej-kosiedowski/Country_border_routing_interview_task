<?php declare(strict_types = 1);

namespace Tests\Unit\Rule;

use App\Rules\Cca3ExistRule;
use App\Service\Country\Parser\CountryDataParser;
use JsonException;
use Psy\Exception\RuntimeException;
use Tests\TestCase;
use Mockery;
use Mockery\MockInterface;

class Cca3ExistRuleTest extends TestCase
{

    private Cca3ExistRule $cca3ExistRule;

    /**
     * @return array[]
     */
    public static function smallValueDataProvider(): array
    {
        return [
            'pol' => ['pol'],
            'Pol' => ['Pol'],
            'pOL' => ['pOL'],
            'Mex' => ['MeX'],
            'MEX' => ['MEX'],
            'POL' => ['POL'],
        ];
    }

    public static function InvalidValueDataProvider(): array
    {
        return [
            'fra' => ['fra'],
            'FRA' => ['FRA'],
            'WWW' => ['WWW'],
            'ABC' => ['ABC'],
            'ooo' => ['ooo'],
            'OOO' => ['OOO'],
        ];
    }

    /**
     * @param string $value
     *
     * @return void
     * @throws JsonException
     * @dataProvider smallValueDataProvider
     */
    public function testSmallLetter(string $value): void
    {
        $this->cca3ExistRule->validate('cca3', $value, function ($fail) {
            echo $fail;
        });
    }

    /**
     * @param string $value
     *
     * @return void
     * @throws JsonException
     * @dataProvider InvalidValueDataProvider
     */
    public function testShouldFailIfDataIsNotInList(string $value): void
    {
        $this->expectException(RuntimeException::class);
        $this->cca3ExistRule->validate('cca3', $value, function ($fail) {
            throw new RuntimeException($fail);
        });
    }

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->instance(
            CountryDataParser::class,
            Mockery::mock(CountryDataParser::class, function (MockInterface $mock) {
                $mock->shouldReceive('getCca3')->andReturns(
                    [
                        'POL',
                        'CZE',
                        'USA',
                        'MEX',
                    ]
                )->once();
            })
        );
        $this->cca3ExistRule = app(Cca3ExistRule::class);
    }
}
