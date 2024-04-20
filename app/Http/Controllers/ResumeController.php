<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResumeResource;
use App\Models\Application;
use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Application $application)
    {
        return new ResumeResource($application->resumes()->latest()->first());
    }

    public function show(Resume $resume)
    {
        return view('resume', ['resume' => $resume, 'user' => auth()->user()]);
    }

    public function download(Resume $resume)
    {
        $pdf = Pdf::loadView('resume', ['resume' => $resume, 'user' => auth()->user()])->download('resume.pdf');

        return response($pdf, 200, ['Content-Type' => 'application/pdf']);
    }
}
