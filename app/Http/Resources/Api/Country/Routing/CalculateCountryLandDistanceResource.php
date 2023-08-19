<?php

namespace App\Http\Resources\Api\Country\Routing;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalculateCountryLandDistanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'route' => $this->resource,
        ];
    }
}
