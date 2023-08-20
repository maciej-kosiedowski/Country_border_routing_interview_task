<?php

declare(strict_types=1);

namespace Tests\Unit\Rule;

use App\Rules\Cca3ExistRule;
use App\Service\Country\Parser\CountryDataParser;
use Illuminate\Translation\PotentiallyTranslatedString;
use JsonException;
use Mockery;
use Mockery\MockInterface;
use Psy\Exception\RuntimeException;
use Tests\TestCase;

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
     * @throws JsonException
     *
     * @dataProvider smallValueDataProvider
     */
    public function testSmallLetter(string $value): void
    {
        $this->cca3ExistRule->validate('cca3', $value, function (string $fail): PotentiallyTranslatedString {
            return app(PotentiallyTranslatedString::class, ['string' => $fail]);
        });
    }

    /**
     * @throws JsonException
     *
     * @dataProvider InvalidValueDataProvider
     */
    public function testShouldFailIfDataIsNotInList(string $value): void
    {
        $this->expectException(RuntimeException::class);
        $this->cca3ExistRule->validate('cca3', $value, function ($fail) {
            throw new RuntimeException($fail);
        });
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->instance(
            CountryDataParser::class,
            Mockery::mock(CountryDataParser::class, static function (MockInterface $mock) {
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
