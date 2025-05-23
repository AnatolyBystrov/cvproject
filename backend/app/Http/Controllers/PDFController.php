<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            Log::info('Gemini CV summary response:', $json);

            $data['ai_summary'] = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'No summary generated.';
        } else {
            Log::error('Gemini API error (CV summary):', [
                'status' => $aiResponse->status(),
                'body' => $aiResponse->body()
            ]);
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
                Log::info('Gemini Cover Letter PDF response:', $result);

                $data['cover_letter'] = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Cover letter could not be generated.';
            } else {
                Log::error('Gemini API error (PDF cover letter):', [
                    'status' => $ai->status(),
                    'body' => $ai->body()
                ]);
            }
        }

        $pdf = Pdf::loadView('pdf.cover_letter', $data);

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Access-Control-Allow-Origin', '*');
    }

    public function generateCoverLetterText(Request $request)
    {
        $data = $request->only(['position', 'experience', 'education', 'skills', 'name']);
    
        $prompt = "
            You are a professional career advisor. 
            Please create a detailed, engaging, and highly professional cover letter for a candidate applying for the {$data['position']} role.
            The candidate's experience is: {$data['experience']}.
            The candidate's education is: {$data['education']}.
            The candidate's skills include: {$data['skills']}.
            Make the tone of the cover letter confident, enthusiastic, and suitable for a modern technology company. 
            Structure the letter properly, with an opening, body paragraphs, and a closing thanking the employer for their consideration.
        ";
    
        $ai = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(env('GEMINI_API_URL') . '?key=' . env('GEMINI_API_KEY'), [
            'contents' => [
                ['parts' => [[
                    'text' => $prompt
                ]]]
            ]
        ]);
    
        $coverLetter = '';
    
        if ($ai->successful()) {
            $result = $ai->json();
            Log::info('Gemini Cover Letter Text response:', $result);
    
            $coverLetter = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
        } else {
            Log::error('Gemini API error (text generation):', [
                'status' => $ai->status(),
                'body' => $ai->body()
            ]);
        }
    
        if (empty($coverLetter)) {
            $coverLetter = "Dear Hiring Manager,\n\nI am excited to apply for the {$data['position']} position. With my background in {$data['education']} and my experience in {$data['experience']}, I am confident that I will contribute significantly to your company.\n\nThank you for considering my application.\n\nSincerely,\n\n{$data['name']}";
        }
    
        return response()->json(['cover_letter' => $coverLetter]);
    }
    
}
