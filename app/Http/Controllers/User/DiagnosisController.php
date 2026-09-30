<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Consultation;
use App\Models\Category;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the user's past diagnoses.
     */
    public function index()
    {
        $consultations = Consultation::where('user_id', auth()->id())
            ->with(['device', 'diagnosis'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('user.diagnosis.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new diagnosis (Upload Photo & Device Info).
     */
    public function create()
    {
        $categories = Category::with('devices')->where('is_active', true)->get();
        return view('user.diagnosis.create', compact('categories'));
    }

    /**
     * Store the initial diagnosis request and start the session.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|exists:devices,id',
            'damage_photo' => 'required_without:camera_image_base64|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
            'camera_image_base64' => 'required_without:damage_photo|string',
            'additional_description' => 'nullable|string',
        ]);

        // Create consultation record
        $consultationCode = 'CNS-' . strtoupper(uniqid());
        $consultation = Consultation::create([
            'user_id' => auth()->id(),
            'device_id' => $validated['device_id'],
            'consultation_code' => $consultationCode,
            'status' => 'in_progress',
        ]);

        // Handle Image Upload
        $imagePath = null;
        $folderPath = 'public/consultations/' . date('Y/m');

        $geminiBase64 = null;
        $mimeType = 'image/jpeg';
        
        if ($request->hasFile('damage_photo')) {
            // Upload from File Picker
            $file = $request->file('damage_photo');
            $path = $file->store($folderPath);
            $imagePath = str_replace('public/', '', $path);
            
            $geminiBase64 = base64_encode(file_get_contents($file->getRealPath()));
            $mimeType = $file->getMimeType();
        } elseif (!empty($request->camera_image_base64)) {
            // Upload from Web Camera Base64
            $base64Image = $request->camera_image_base64;
            $geminiBase64 = $base64Image; // raw
            
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Data = substr($base64Image, strpos($base64Image, ',') + 1);
                $ext = strtolower($type[1]);
                $mimeType = 'image/' . $ext;
                
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $decodedImage = base64_decode($base64Data);
                    if ($decodedImage !== false) {
                        $fileName = uniqid() . '.' . $ext;
                        $path = $folderPath . '/' . $fileName;
                        \Illuminate\Support\Facades\Storage::put($path, $decodedImage);
                        $imagePath = str_replace('public/', '', $path);
                    }
                }
            }
        }

        if ($imagePath) {
            $consultation->consultationImages()->create([
                'image_path' => $imagePath,
                'description' => $validated['additional_description'] ?? null,
            ]);
        }

        // TRIGGER GEMINI AI ANALYSIS
        $gemini = new \App\Services\GeminiDiagnosisService();
        $deviceName = $consultation->device->name;
        $description = $validated['additional_description'] ?? '';
        
        $aiResult = $gemini->analyze($geminiBase64, $mimeType, $description, $deviceName);
        
        // Update Consultation
        $consultation->update([
            'status' => 'completed',
            'result' => $aiResult,
            'confidence' => 95.00 // Example
        ]);
        
        return redirect()->route('user.diagnosis.show', $consultation->id)
            ->with('success', 'Analisis AI selesai dilakukan!');
    }

    /**
     * Show the AI diagnosis result.
     */
    public function show(string $id)
    {
        $consultation = Consultation::where('user_id', auth()->id())
            ->with(['device', 'consultationImages'])
            ->findOrFail($id);

        return view('user.diagnosis.show', compact('consultation'));
    }

    public function uploadImage(Request $request, string $id)
    {
        // For additional images during consultation
    }

    public function submitAnswer(Request $request, string $id)
    {
        // Handle answers to expert system questions
    }

    public function showResult(string $id)
    {
        // Show final diagnosis result
    }
}
