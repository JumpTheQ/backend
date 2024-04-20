<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoverLetterResource;
use App\Models\Application;
use App\Models\CoverLetter;

class CoverLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Application $application)
    {
        return CoverLetterResource::colection($application->coverLetters()->get());
    }

    public function download(CoverLetter $coverLetter)
    {
        //
    }
}
