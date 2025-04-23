<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;

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

        $aiResponse = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(env('GEMINI_API_URL') . '?key=' . env('GEMINI_API_KEY'), [
            'contents' => [
                ['parts' => [[
                    'text' => "Generate a professional CV summary for the position of {$data['position']} based on this experience:\n{$data['experience']} \nEducation: {$data['education']} \nSkills: {$data['skills']}"
                ]]]
            ]
        ]);

        $data['ai_summary'] = '';
        if ($aiResponse->successful()) {
            $json = $aiResponse->json();
            $data['ai_summary'] = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';
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

        if (empty($data['cover_letter'])) {
            $ai = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post(env('GEMINI_API_URL') . '?key=' . env('GEMINI_API_KEY'), [
                'contents' => [
                    ['parts' => [[
                        'text' => "Write a professional cover letter for the {$data['position']} position. Experience: {$data['experience']}. Education: {$data['education']}. Skills: {$data['skills']}"
                    ]]]
                ]
            ]);

            if ($ai->successful()) {
                $result = $ai->json();
                $data['cover_letter'] = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
            }
        }

        $pdf = Pdf::loadView('pdf.cover_letter', $data);
        return $pdf->download('cover_letter.pdf');
    }

    public function generateCoverLetterText(Request $request)
    {
        $data = $request->only(['position', 'experience', 'education', 'skills']);

        $ai = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(env('GEMINI_API_URL') . '?key=' . env('GEMINI_API_KEY'), [
            'contents' => [
                ['parts' => [[
                    'text' => "Write a professional cover letter for the {$data['position']} position. Experience: {$data['experience']}. Education: {$data['education']}. Skills: {$data['skills']}"
                ]]]
            ]
        ]);

        $coverLetter = '';
        if ($ai->successful()) {
            $result = $ai->json();
            $coverLetter = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
        }

        return response()->json(['cover_letter' => $coverLetter]);
    }
}
