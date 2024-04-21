<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoverLetterResource;
use App\Models\Application;
use App\Models\CoverLetter;
use Barryvdh\DomPDF\Facade\Pdf;

class CoverLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Application $application)
    {
        return new CoverLetterResource($application->coverLetters()->latest()->first());
    }

    public function show(Application $application, CoverLetter $coverLetter)
    {
        return view('coverLetter', ['coverLetter' => $coverLetter]);
    }

    public function download(Application $application, CoverLetter $coverLetter)
    {
        $pdf = Pdf::loadView('coverLetter', ['coverLetter' => $coverLetter])->download('cover-letter.pdf');

        return response($pdf, 200, ['Content-Type' => 'application/pdf']);
    }
}
