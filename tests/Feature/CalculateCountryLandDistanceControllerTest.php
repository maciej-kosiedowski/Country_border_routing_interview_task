<?php declare(strict_types = 1);

namespace Tests\Feature;
use Tests\TestCase;

class CalculateCountryLandDistanceControllerTest extends TestCase
{
    public static function commonBorderDataProvider(): array
    {
       return [
           'ALB & MNE' => ['ALB', 'MNE'],
           'ALB & GRC' => ['ALB', 'GRC'],
           'BTN & MNE' => ['BTN', 'CHN'],
           'BTN & GRC' => ['BTN', 'IND'],
       ];
    }

    /**
     * @param string $origin
     * @param string $destination
     *
     * @return void
     * @dataProvider commonBorderDataProvider
     */
    public function testOriginCountryAndDestinationCountryHasCommonBorder(string $origin, string $destination): void
    {

        $response = $this->get(route('api.country.border.check', [$origin, $destination]));
        $response->assertStatus(200);
    }
}
