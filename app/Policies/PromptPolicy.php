<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\Prompt;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PromptPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }

    /**
     * Determine whether the user can create the model.
     */
    public function create(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Prompt $prompt): bool
    {
        return $user->id === $prompt->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Prompt $prompt): bool
    {
        return $user->id === $prompt->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Prompt $prompt): bool
    {
        return $user->id === $prompt->user_id;
    }
}
