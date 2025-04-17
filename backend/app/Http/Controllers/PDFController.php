<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generate(Request $request)
    {
        if (empty(trim($html))) {
            return response("Generated HTML is empty!", 500);
        }        
        $pdf = Pdf::loadView('pdf.cv', $request->all());

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'cv.pdf');
    }
}
