<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResumeResource;
use App\Models\Application;
use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Provider\Lorem;

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
        return view('resume', [
            'resume' => $resume,
            'user' => auth()->user(),
            'skills' => ['react', 'project-management', 'frontend-development'],
            'about' => "Lorem ipsum dolor sit amet consectetur. Nisi odio arcu adipiscing quis. Duis sit vel duis leo urna ut. Eget vel tortor blandit diam. Cras ultrices porttitor in eget vel leo. Vel tempor a et porttitor amet. Commodo tincidunt eget neque orci. Eget quam."
        ]);
    }

    public function download(Resume $resume)
    {
        $pdf = Pdf::loadView('resume', [
            'resume' => $resume,
            'user' => auth()->user(),
            'skills' => ['react', 'project-management', 'frontend-development'],
            'about' => "Lorem ipsum dolor sit amet consectetur. Nisi odio arcu adipiscing quis. Duis sit vel duis leo urna ut. Eget vel tortor blandit diam. Cras ultrices porttitor in eget vel leo. Vel tempor a et porttitor amet. Commodo tincidunt eget neque orci. Eget quam."
        ])->download('resume.pdf');

        return response($pdf, 200, ['Content-Type' => 'application/pdf']);
    }
}
