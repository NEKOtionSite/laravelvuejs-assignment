<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        // Password validation rules:
        // - The password is required.
        // - The password must be a string.
        // - The password must pass Laravel Fortify's Password rule (minimum length, uppercase, lowercase, etc.).
        // - The password must be confirmed (a 'password_confirmation' field must match the 'password' field).
        return ['required', 'string', new Password, 'confirmed'];
    }
}
