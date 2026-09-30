<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImageAnalysisService
{
    /**
     * Analyze image using OpenAI Vision API to extract visual evidence of damage.
     *
     * @param string $imageUrl Accessible URL of the image or base64 string
     * @return array|null JSON structured response of visual conditions
     */
    public function analyzeImage($imageBase64)
    {
        $apiKey = env('OPENAI_API_KEY');
        $model = env('OPENAI_MODEL', 'gpt-4o');

        if (empty($apiKey)) {
            Log::error('OpenAI API Key is missing.');
            return null;
        }

        $prompt = "You are an expert appliance and electronic device technician. "
                . "Analyze this image and identify visual evidence of damage. "
                . "Respond ONLY with a JSON object in this exact format, with no markdown formatting or extra text: "
                . '{"detected_objects": ["object1"], "visual_conditions": ["condition1"], "confidence": 0.85}';

        try {
            $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/chat/completions', [
                'model' => $model,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => [
                            ['type' => 'text', 'text' => $prompt],
                            [
                                'type' => 'image_url',
                                'image_url' => [
                                    'url' => 'data:image/jpeg;base64,' . $imageBase64
                                ]
                            ]
                        ]
                    ]
                ],
                'max_tokens' => 300
            ]);

            if ($response->successful()) {
                $content = $response->json('choices.0.message.content');
                // Clean up in case OpenAI returns markdown code blocks
                $content = str_replace(['```json', '```'], '', $content);
                return json_decode(trim($content), true);
            }

            Log::error('OpenAI Vision API Error: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('Exception in ImageAnalysisService: ' . $e->getMessage());
            return null;
        }
    }
}
