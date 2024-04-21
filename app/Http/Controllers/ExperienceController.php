<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;use Illuminate\Support\Facades\Gate;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ExperienceResource::collection(auth()->user()->experiences()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExperienceRequest $request)
    {
        $experience = auth()->user()->experiences()->create($request->validated());

        return new ExperienceResource($experience);
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        Gate::authorize('view', $experience);

        return new ExperienceResource($experience);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        Gate::authorize('update', $experience);
        $experience->update($request->validated());

        return new ExperienceResource($experience);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        Gate::authorize('delete', $experience);

        $experience->delete();

        return response(null, 204);
    }
}
