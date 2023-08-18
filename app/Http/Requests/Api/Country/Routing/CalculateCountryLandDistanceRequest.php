<?php

namespace App\Http\Requests\Api\Country\Routing;

use App\Http\Requests\Api\BaseApiRequest;
use App\Rules\Cca3ExistRule;
use Illuminate\Contracts\Validation\ValidationRule;

class CalculateCountryLandDistanceRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'origin' => ['required', 'string', 'size:3', new Cca3ExistRule],
            'destination' => ['required', 'string', 'size:3',  new Cca3ExistRule],
        ];
    }
}
