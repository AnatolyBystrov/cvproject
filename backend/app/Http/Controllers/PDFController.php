<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->only([
            'name',
            'position',
            'experience',
            'education',
            'skills',
            'hobbies',
            'cover_letter'
        ]);

        if (!View::exists('pdf.cv')) {
            return response()->json(['error' => 'CV view not found.'], 500);
        }

        $html = view('pdf.cv', $data)->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Access-Control-Allow-Origin', '*');
    }

    public function generateCoverLetter(Request $request)
    {
        $data = $request->all();
        $pdf = \PDF::loadView('pdf.cover_letter', $data);
        return $pdf->download('cover_letter.pdf');
    }
    
}
