<?php

namespace App\Policies;

use App\Models\Language;
use App\Models\User;

class LanguagePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Language $language): bool
    {
        return $user->id === $language->user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Language $language): bool
    {
        return $user->id === $language->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Language $language): bool
    {
        return $user->id === $language->user->id;
    }
}
