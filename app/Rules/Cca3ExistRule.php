<?php

namespace App\Rules;

use App\Service\Country\Parser\CountryDataParser;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use JsonException;

class Cca3ExistRule implements ValidationRule
{
    public function __construct(private readonly CountryDataParser $countryJsonParser)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     *
     * @throws JsonException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! in_array(strtoupper($value), $this->countryJsonParser->getCca3(), false)) {
            $fail('The :attribute must be in Cca3 country list.');
        }
    }
}
