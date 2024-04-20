<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Support\Facades\Gate;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Section::class);

        return Section::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request)
    {
        Gate::authorize('store', Section::class);

        $section = Section::create($request->validated());

        return new SectionResource($section);
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        Gate::authorize('view', $section);

        return new SectionResource($section);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        Gate::authorize('update', $section);

        $section = Section::update($request->validated());

        return new SectionResource($section);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        Gate::authorize('delete', $section);

        $section->delete();

        return response(null, 204);
    }
}
