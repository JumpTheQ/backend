<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResumeResource;
use App\Models\Application;
use App\Models\Resume;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Application $application)
    {
        return ResumeResource::collection($application->resumes()->get());
    }

    public function download(Resume $resume)
    {
        //
    }
}
