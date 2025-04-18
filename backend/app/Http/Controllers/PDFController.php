<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generate(Request $request)
    {
        $name = $request->input('name');
        $position = $request->input('position');
        $experience = $request->input('experience');
        $education = $request->input('education');
        $skills = $request->input('skills');
        $hobbies = $request->input('hobbies');
        $coverLetter = $request->input('cover_letter');

        $html = view('pdf.cv', [
            'name' => $name,
            'position' => $position,
            'experience' => $experience,
            'education' => $education,
            'skills' => $skills,
            'hobbies' => $hobbies,
            'cover_letter' => $coverLetter,
        ])->render();

        $pdf = Pdf::loadHTML($html);

        return $pdf->download('cv.pdf');
    }
}
