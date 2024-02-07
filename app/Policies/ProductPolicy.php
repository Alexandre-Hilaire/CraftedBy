<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function store(User $user){
        return $user->isAdmin() || $user->isCrafter();
    }

    public function update(User $user, Product $product){
        return $user->isAdmin() || ($user->isCrafter() && $product->user_id === $user->id);
    }
    
    public function destroy(User $user, Product $product){
        return $user->isAdmin() || ($user->isCrafter() && $product->user_id === $user->id);
    }
}
