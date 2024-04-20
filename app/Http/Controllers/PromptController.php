<?php

namespace App\Http\Controllers;

use App\Actions\HandlePromptAction;
use App\Http\Requests\StorePromptRequest;
use App\Http\Requests\UpdatePromptRequest;
use App\Http\Resources\PromptResource;
use App\Models\Application;
use App\Models\Prompt;
use Illuminate\Support\Facades\Gate;

class PromptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Application $application)
    {
        Gate::authorize('viewAny', $application);

        return PromptResource::collection($application->prompts());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromptRequest $request, Application $application, HandlePromptAction $handlePromptAction)
    {
        Gate::authorize('create', $application);

        /** @var Prompt $prompt */
        $prompt = $application->prompts()->create($request->validated());

        $handlePromptAction($prompt);

        return new PromptResource($prompt);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromptRequest $request, Prompt $prompt, HandlePromptAction $handlePromptAction)
    {
        Gate::authorize('update', $prompt);

        $prompt->update($request->validated());

        $handlePromptAction($prompt);

        return new PromptResource($prompt);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application, Prompt $prompt)
    {
        Gate::authorize('delete', $prompt);

        $application->delete();

        return response(null, 204);
    }
}
