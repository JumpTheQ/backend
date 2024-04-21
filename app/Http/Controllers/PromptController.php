<?php

namespace App\Http\Controllers;

use App\Actions\HandlePromptSavedAction;
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
        Gate::authorize('viewAny', [Prompt::class, $application]);

        return PromptResource::collection($application->prompts()->where('generated', '=', false)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromptRequest $request, Application $application)
    {
        Gate::authorize('create', [Prompt::class, $application]);

        /** @var Prompt $prompt */
        $prompt = $application->prompts()->make($request->validated());

        $prompt->user_id = auth()->user()->id;

        $prompt->save();

        return new PromptResource($prompt);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromptRequest $request, Prompt $prompt)
    {
        Gate::authorize('update', $prompt);

        $prompt->update($request->validated());

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
