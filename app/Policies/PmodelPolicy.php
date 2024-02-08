<?php

namespace App\Policies;

use App\Models\User;

class PmodelPolicy
{

    public function store (User $user){
        return $user->isAdmin() || $user->isCrafter();
    }
    public function update (User $user){
        return $user->isAdmin() || $user->isCrafter();
    }
    public function destroy (User $user){
        return $user->isAdmin() || $user->isCrafter();
    }
    
}
