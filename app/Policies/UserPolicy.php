<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->id === auth()->user()->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->id === auth()->user()->id;
    }
}
