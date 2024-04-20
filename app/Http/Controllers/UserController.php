<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        Gate::authorize('view', $user);

        return new UserResource(auth()->user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        Gate::authorize('update', $user);

        $user->update($request->validated());

        return new UserResource($user);
    }
}
