<?php

namespace App\Policies;

use App\Models\Crafter;
use App\Models\User;

class CrafterPolicy
{

    public function update(User $user, Crafter $crafter) {
        return $user->isAdmin() || ($user->isCrafter() && $crafter->user_id === $user->id);
    }
    public function destroy(User $user, Crafter $crafter){
        return $user->isAdmin() || ($user->isCrafter() && $crafter->user_id === $user->id);
    }

}
