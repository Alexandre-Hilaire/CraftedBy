<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function update(User $user, Order $order){
        return $user->isAdmin() || $order->user_id === $user->id; 
    }
    public function destroy(User $user, Order $order){
        return $user->isAdmin() || $order->user_id === $user->id;
    }
}
