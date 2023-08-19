<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class CalculateCountryLandDistanceControllerTest extends TestCase
{
    public static function commonBorderDataProvider(): array
    {
        return [
            'ALB & MNE' => ['ALB', 'MNE'],
            'ALB & GRC' => ['ALB', 'GRC'],
            'BTN & CHN' => ['BTN', 'CHN'],
            'BTN & GRC' => ['BTN', 'IND'],
            'CZE & POL' => ['CZE', 'POL'],
            'CZE & POL small' => ['cze', 'pol'],
            'CZE & POL first capital letter' => ['Cze', 'Pol'],
            'CZE & POL first capital in origin' => ['CZE', 'pol'],
            'CZE & POL first capital in destination' => ['cze', 'POL'],
        ];
    }

    /**
     * @dataProvider commonBorderDataProvider
     */
    public function testOriginCountryAndDestinationCountryHasCommonBorder(string $origin, string $destination): void
    {
        $response = $this->getJson(
            route('api.country.border.check', ['origin' => $origin, 'destination' => $destination])
        );
        $response->assertStatus(200);
        $response->assertJson(
            [
                'data' => [
                    'route' => [
                        strtoupper($origin), strtoupper($destination),
                    ],
                ],
            ]
        );
    }

    public static function noBorderDataProvider(): array
    {
        return [
            'AIA & ALA' => ['AIA', 'ALA'],
            'CRI & POL' => ['CRI', 'POL'],
            'MEX & GRC' => ['MEX', 'GRC'],
            'POL & USA' => ['POL', 'USA'],
        ];
    }

    /**
     * @dataProvider noBorderDataProvider
     */
    public function testOriginCountryAndDestinationCountryNoBorder(string $origin, string $destination): void
    {
        $response = $this->getJson(
            route('api.country.border.check', ['origin' => $origin, 'destination' => $destination])
        );
        $response->assertStatus(400);
    }


    public static function landConnectionButNoBorderDataProvider(): array
    {
        return [
            'POL & FRA' => ['POL', 'FRA', ['POL', 'DEU', "FRA"]],
            'POL & ITA' => ['POL', 'ITA', ['POL', 'SVK', 'AUT', 'ITA']],
            'CZE & ITA' => ['CZE', 'ITA', ['CZE', 'AUT', 'ITA']],
        ];
    }

    /**
     * @dataProvider landConnectionButNoBorderDataProvider
     */
    public function testOriginCountryAndDestinationCountryHasLandConnectionButNoBorder(string $origin, string $destination, array $expected): void
    {
        $response = $this->getJson(
            route('api.country.border.check', ['origin' => $origin, 'destination' => $destination])
        );
        $response->assertStatus(200);
        $response->assertJson(
            [
                'data' => [
                    'route' => $expected,
                ],
            ]
        );
    }
}
