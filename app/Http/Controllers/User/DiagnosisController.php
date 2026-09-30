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

        if ($request->hasFile('damage_photo')) {
            // Upload from File Picker
            $path = $request->file('damage_photo')->store($folderPath);
            $imagePath = str_replace('public/', '', $path);
        } elseif (!empty($request->camera_image_base64)) {
            // Upload from Web Camera Base64
            $base64Image = $request->camera_image_base64;
            
            // Format is usually "data:image/jpeg;base64,....."
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, etc
                
                if (in_array($type, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $base64Image = base64_decode($base64Image);
                    
                    if ($base64Image !== false) {
                        $fileName = uniqid() . '.' . $type;
                        $path = $folderPath . '/' . $fileName;
                        
                        \Illuminate\Support\Facades\Storage::put($path, $base64Image);
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

        // Note: AI Vision analysis would typically be triggered here via Job/Queue
        // For now, we proceed to the questions view
        
        return redirect()->route('user.diagnosis.show', $consultation->id)
            ->with('success', 'Foto berhasil diunggah. Mari kita mulai diagnosis.');
    }

    /**
     * Show the expert system questionnaire.
     */
    public function show(string $id)
    {
        $consultation = Consultation::where('user_id', auth()->id())
            ->with(['device', 'consultationImages'])
            ->findOrFail($id);

        // This is where ExpertSystemService getNextQuestion would be called
        // For the scaffolding phase, we'll just display a placeholder view
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
