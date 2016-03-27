<?php

namespace App\Repositories;

use App\User;
use App\Measurement;

class MeasurementRepository
{
    /**
     * Get all of the measurements for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Measurement::where('user_id', $user->id)
                    ->orderBy('date', 'asc')
                    ->get();
    }
}