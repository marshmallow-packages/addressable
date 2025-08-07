<?php

namespace Marshmallow\Addressable\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Closure;

class AddressRule implements ValidationRule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Validation logic here - currently always passes
        // If validation fails, call: $fail('Validation error message')
    }
}
