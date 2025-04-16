<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class GenerateController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|string',
            'hobbies' => 'nullable|string',
            'cover_letter' => 'required|string',
        ]);

        $pdf = Pdf::loadView('pdf.cv', $data);

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="cv.pdf"');
    }
}
