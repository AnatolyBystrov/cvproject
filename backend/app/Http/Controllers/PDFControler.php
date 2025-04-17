<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->only([
            'name', 'position', 'experience',
            'education', 'skills', 'hobbies', 'cover_letter',
        ]);

        $pdf = Pdf::loadView('pdf.cv', $data);

        return $pdf->download('cv.pdf');
    }
}
