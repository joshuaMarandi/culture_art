<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Art; // Import the Art model
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can update the given art.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Art  $art
     * @return bool
     */
    public function update(User $user, Art $art)
    {
        return $user->id === $art->user_id;
    }

    /**
     * Determine if the given user can delete the given art.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Art  $art
     * @return bool
     */
    public function delete(User $user, Art $art)
    {
        return $user->id === $art->user_id;
    }
}
