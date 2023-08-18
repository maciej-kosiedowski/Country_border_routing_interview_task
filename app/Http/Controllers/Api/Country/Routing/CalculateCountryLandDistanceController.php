<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Country\Routing;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Country\Routing\CalculateCountryLandDistanceRequest;
use App\Http\Resources\Api\Country\Routing\CalculateCountryLandDistanceResource;
use App\Service\Country\Routing\CalculateCountryLandDistance;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CalculateCountryLandDistanceController extends ApiController
{
    public function __construct(private readonly CalculateCountryLandDistance $calculateCountryLandDistance)
    {
    }

    public function __invoke(CalculateCountryLandDistanceRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $result = $this->calculateCountryLandDistance->handle($validatedData['origin'], $validatedData['destination']);

        if ($result === null || $result === []) {
            return new JsonResponse(status: Response::HTTP_BAD_REQUEST);
        }

        return (new CalculateCountryLandDistanceResource(
            $result
        ))->response();
    }
}
