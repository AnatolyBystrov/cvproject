<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'position' => 'required|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'skills' => 'nullable|string',
            'hobbies' => 'nullable|string',
            'cover_letter' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'name', 'position', 'experience', 'education', 'skills', 'hobbies', 'cover_letter'
        ]);

        $html = view('pdf.cv', $data)->render();
        $pdf = Pdf::loadHTML($html);

        return $pdf->download('cv.pdf');
    }
}
