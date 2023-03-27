<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GPTService
{
    public function generate($prompt)
    {
        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . config('app.open_ai_api_key'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/engines/text-davinci-003/completions', [
                'prompt' => $prompt,
                'temperature' => 0.6,
                'max_tokens' => 250,
                'top_p' => 1,
                'frequency_penalty' => 1,
                'presence_penalty' => 1,
            ]);
            // ->withOptions(["verify" => false]);

        $result = $response->json();
        return $result['choices'][0]['text'];
    }
}
