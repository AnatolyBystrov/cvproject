<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
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

        if (!View::exists('pdf.cv')) {
            return response("Blade template not found", 404);
        }

        $pdf = Pdf::loadView('pdf.cv', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'cv.pdf', ['Content-Type' => 'application/pdf']);
    }
}
