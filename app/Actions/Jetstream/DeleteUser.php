<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  \App\Models\User  $user The user model to be deleted.
     * @return void
     */
    public function delete(User $user): void
    {
        // Delete the user's profile photo, if it exists.
        $user->deleteProfilePhoto();

        // Delete all the user's personal access tokens.
        $user->tokens->each->delete();

        // Finally, delete the user record from the database.
        $user->delete();
    }
}
