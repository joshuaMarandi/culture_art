<?php

// app/Policies/ArtPolicy.php

namespace App\Policies;

use App\Models\Art;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Art $art)
    {
        return $user->id === $art->user_id;
    }

    public function delete(User $user, Art $art)
    {
        return $user->id === $art->user_id;
    }
}
