<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  \App\Models\User  $user The user model whose profile information will be updated.
     * @param  array<string, string>  $input The input data containing the updated profile information.
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException If validation fails.
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        // Update the user's profile photo if provided in the input.
        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        // If the email is changed for a verified user, update email_verified_at and send verification email.
        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            // Update the user's profile information (first name, last name, email).
            $user->forceFill([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  \App\Models\User  $user The verified user model whose profile information will be updated.
     * @param  array<string, string>  $input The input data containing the updated profile information.
     * @return void
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        // Update the verified user's profile information (first name, last name, email).
        $user->forceFill([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        // Send an email verification notification to the user.
        $user->sendEmailVerificationNotification();
    }
}
