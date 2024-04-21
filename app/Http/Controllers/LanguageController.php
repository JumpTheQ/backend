<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;use Illuminate\Support\Facades\Gate;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return LanguageResource::collection(auth()->user()->languages()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {
        $language = auth()->user()->languages()->create($request->validated());

        return new LanguageResource($language);
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        Gate::authorize('view', $language);

        return new LanguageResource($language);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, Language $language)
    {
        Gate::authorize('update', $language);
        $language->update($request->validated());

        return new LanguageResource($language);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        Gate::authorize('delete', $language);

        $language->delete();

        return response(null, 204);
    }
}
