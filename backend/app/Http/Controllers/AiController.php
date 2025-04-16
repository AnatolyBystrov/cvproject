<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
        ]);

        // Disable AI in production if no key is provided
        if (app()->environment('production') && empty(env('OPENAI_API_KEY'))) {
            Log::warning('⚠️ AI is disabled in production due to missing API key.');
            return response()->json([
                'error' => 'AI feature is disabled in production environment.'
            ], 403);
        }

        $prompt = "Write a short, professional and friendly cover letter for a person named {$request->name} applying for a position as a {$request->position}. Emphasize adaptability, technical skills, and enthusiasm.";

        Log::info('📤 Sending request to OpenAI...');
        Log::info('🔑 Using API key: ' . substr(env('OPENAI_API_KEY'), 0, 10) . '...');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
                'max_tokens' => 300,
            ]);

            if ($response->failed()) {
                Log::error('❌ OpenAI request failed', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);

                return response()->json([
                    'error' => 'AI request failed.',
                    'details' => $response->json()
                ], 500);
            }

            Log::info('✅ OpenAI request successful.');

            return response()->json([
                'cover_letter' => $response->json()['choices'][0]['message']['content']
            ]);
        } catch (\Exception $e) {
            Log::error('💥 Exception while requesting OpenAI', [
                'message' => $e->getMessage()
            ]);

            return response()->json([
                'error' => 'An unexpected error occurred.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
