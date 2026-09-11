<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ProhibitedWords implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $blocked = ['spam', 'estafa'];

        foreach ($blocked as $word) {
            if (str_contains(mb_strtolower((string) $value), $word)) {
                $fail('El :attribute contiene una palabra no permitida');
                return;
            }
        }
    }
}
