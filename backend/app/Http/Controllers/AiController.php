
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{

    public function generate(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'position' => 'required|string'
    ]);

    $prompt = "Write a short, professional and friendly cover letter for a person named {$request->name} applying for a position as a {$request->position}. Emphasize adaptability, technical skills, and enthusiasm.";

    \Log::info('📤  OpenAI ');
    \Log::info('🔑 ' . substr(env('OPENAI_API_KEY'), 0, 10) . '...');

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
            \Log::error('❌ OpenAI', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            return response()->json([
                'error' => 'AI request failed',
                'details' => $response->json()
            ], 500);
        }

        \Log::info('✅ OpenAI');

        return response()->json([
            'cover_letter' => $response->json()['choices'][0]['message']['content']
        ]);
    } catch (\Exception $e) {
        \Log::error('💥 OpenAI', ['message' => $e->getMessage()]);

        return response()->json([
            'error' => 'Something went wrong',
            'details' => $e->getMessage()
        ], 500);
    }
}

}
