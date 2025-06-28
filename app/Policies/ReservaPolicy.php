<?php

namespace App\Policies;

use App\Models\Reserva;
use App\Models\User;

class ReservaPolicy
{
    public function update(User $user, Reserva $reserva)
    {
        return $user->id === $reserva->user_id;
    }

    public function delete(User $user, Reserva $reserva)
    {
        return $user->id === $reserva->user_id;
    }
}
