<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    public function update(User $user){
        return $user->isUser() && $user->user_id === $user->id || $user->isAdmin();
    }
    public function destroy (User $user){
        return $user->isUser() && $user->user_id === $user->id || $user->isAdmin();
    }

}
