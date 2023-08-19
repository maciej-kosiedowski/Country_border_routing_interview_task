<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Country\Routing;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Country\Routing\CalculateCountryLandDistanceResource;
use App\Rules\Cca3ExistRule;
use App\Service\Country\Routing\CalculateCountryLandDistance;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JsonException;
use Symfony\Component\HttpFoundation\Response;

class CalculateCountryLandDistanceController extends ApiController
{
    public function __construct(private readonly CalculateCountryLandDistance $calculateCountryLandDistance)
    {
    }

    /**
     * @throws ValidationException
     * @throws JsonException
     */
    public function __invoke(string $origin, string $destination): JsonResponse
    {
        Validator::make(['origin' => $origin, 'destination' => $destination], [
            'origin' => ['required', 'string', 'size:3', app(Cca3ExistRule::class)],
            'destination' => ['required', 'string', 'size:3', app(Cca3ExistRule::class)],
        ])->validate();

        $result = $this->calculateCountryLandDistance->handle($origin, $destination);

        if ($result === null || $result === []) {
            return new JsonResponse(status: Response::HTTP_BAD_REQUEST);
        }

        return (new CalculateCountryLandDistanceResource(
            $result
        ))->response();
    }
}
