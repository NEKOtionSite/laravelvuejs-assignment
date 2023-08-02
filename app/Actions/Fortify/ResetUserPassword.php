<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  User  $user The user model whose password will be reset.
     * @param  array<string, string>  $input The input data containing the new password.
     * @return void
     */
    public function reset(User $user, array $input): void
    {
        // Validate the input data using Laravel's Validator class.
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        // Set the new password for the user and save it to the database.
        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
