<?php

namespace App\Http\Controllers;

use App\Enum\SectionType;
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

    public function show(Application $application, Resume $resume)
    {
        return view('resume', [
            'resume' => $resume,
            'user' => auth()->user(),
            'skills' => $resume->sections()->where('type', '=', SectionType::SKILLS)->first(),
            'about' => $resume->sections()->where('type', '=', SectionType::ABOUT)->first(),
            'experiences' => auth()->user()->experiences()->get(),
            'courses' => auth()->user()->courses()->get(),
            'languages' => auth()->user()->languages()->get(),
            'other' => [],
        ]);
    }

    public function download(Application $application, Resume $resume)
    {
        $pdf = Pdf::loadView('resume', [
            'resume' => $resume,
            'user' => auth()->user(),
            'skills' => $resume->sections()->where('type', '=', SectionType::SKILLS)->first(),
            'about' => $resume->sections()->where('type', '=', SectionType::ABOUT)->first(),
            'experiences' => auth()->user()->experiences()->get(),
            'courses' => auth()->user()->courses()->get(),
            'languages' => auth()->user()->languages()->get(),
            'other' => [],
        ])->download('resume.pdf');

        return response($pdf, 200, ['Content-Type' => 'application/pdf']);
    }
}
