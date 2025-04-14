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

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.cv', $data);

    return $pdf->download('cv.pdf');
}

}
