<?php

namespace App\Rules;

use App\Service\Country\Parser\CountryJsonParser;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class Cca3ExistRule implements ValidationRule
{
    public function __construct(private readonly CountryJsonParser $countryJsonParser)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array($value, $this->countryJsonParser->getCca3(), false)) {
            $fail('The :attribute must be in Cca3 country list.');
        }
    }
}
