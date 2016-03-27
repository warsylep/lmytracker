<?php

namespace App\Policies;

use App\User;
use App\Measurement;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeasurementPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(User $user, Measurement $measurement)
    {
        return $user->id == $measurement->user_id;
    }
}
