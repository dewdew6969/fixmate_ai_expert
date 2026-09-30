<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiDiagnosisService
{
    /**
     * Analyze image and text using Google Gemini 1.5 Flash API
     */
    public function analyze(string $imageBase64 = null, string $mimeType = 'image/jpeg', string $description = '', string $deviceName = '')
    {
        $apiKey = env('GEMINI_API_KEY');
        
        if (empty($apiKey)) {
            return "<h3>Sistem AI Belum Dikonfigurasi</h3><p>Harap tambahkan <code>GEMINI_API_KEY</code> di file <code>.env</code> Anda.</p>";
        }

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey;

        $prompt = "Anda adalah FIXMATE, sebuah AI Pakar Teknisi Perbaikan Elektronik terkemuka di Indonesia. \n";
        $prompt .= "Klien melaporkan kerusakan pada perangkat berikut: **{$deviceName}**. \n";
        if (!empty($description)) {
            $prompt .= "Klien juga memberikan catatan/keluhan: '{$description}'. \n";
        }
        $prompt .= "Jika ada gambar terlampir, perhatikan indikasi kerusakan fisiknya secara detail. \n";
        $prompt .= "Tugas Anda:\n";
        $prompt .= "1. Diagnosis Kerusakan: Jelaskan kemungkinan besar apa yang rusak dan mengapa.\n";
        $prompt .= "2. Panduan Perbaikan Mandiri: Berikan langkah-langkah ringkas jika aman diperbaiki sendiri.\n";
        $prompt .= "3. Rekomendasi Teknisi: Berikan estimasi perbaikan dan imbauan jika mereka harus memanggil mitra teknisi FIXMATE (contoh: berbahaya jika dibongkar sendiri).\n";
        $prompt .= "Jawab dalam Bahasa Indonesia yang profesional, ramah, dan empati. Gunakan format Markdown (bold, list, headings).";

        $payload = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ];

        if ($imageBase64) {
            $base64Data = preg_replace('#^data:image/[^;]+;base64,#', '', $imageBase64);
            // Append image part before the text part for better context
            array_unshift($payload['contents'][0]['parts'], [
                'inline_data' => [
                    'mime_type' => $mimeType,
                    'data' => $base64Data
                ]
            ]);
        }

        try {
            $response = Http::timeout(30)->post($url, $payload);

            if ($response->successful()) {
                $data = $response->json();
                return $data['candidates'][0]['content']['parts'][0]['text'] ?? "Maaf, AI tidak dapat menghasilkan diagnosis saat ini.";
            } else {
                Log::error('Gemini API Error: ' . $response->body());
                return "<h3>Terjadi Kesalahan Koneksi AI</h3><p>Pastikan API Key valid dan koneksi internet stabil. Error: " . $response->status() . "</p>";
            }
        } catch (\Exception $e) {
            Log::error('Gemini Exception: ' . $e->getMessage());
            return "<h3>Terjadi Kesalahan Internal</h3><p>" . $e->getMessage() . "</p>";
        }
    }
}
