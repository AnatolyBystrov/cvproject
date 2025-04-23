<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;
    protected $url;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->url = config('services.gemini.api_url');
    }

    public function generateText(string $prompt): ?string
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("{$this->url}?key={$this->apiKey}", [
            'contents' => [[ 'parts' => [[ 'text' => $prompt ]]]]
        ]);

        if ($response->successful()) {
            return $response->json('candidates.0.content.parts.0.text');
        }

        return null;
    }
}
