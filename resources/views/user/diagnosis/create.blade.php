@extends('layouts.app')

@section('styles')
<style>
    .upload-area {
        border: 2px dashed var(--border-color);
        padding: 2rem;
        border-radius: 0.5rem;
        text-align: center;
        background: rgba(0,0,0,0.2);
        transition: var(--transition);
        position: relative;
    }
    .upload-area:hover {
        border-color: var(--primary);
        background: rgba(59, 130, 246, 0.05);
    }
    .upload-tabs {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    .tab-btn {
        flex: 1;
        padding: 0.75rem;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        border-radius: 0.5rem;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
    }
    .tab-btn.active {
        background: var(--primary);
        border-color: var(--primary);
    }
    #camera-container {
        display: none;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
    #video-preview {
        width: 100%;
        max-width: 400px;
        border-radius: 0.5rem;
        background: #000;
    }
    #photo-preview {
        width: 100%;
        max-width: 400px;
        border-radius: 0.5rem;
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container mt-4 mb-5">
    <div class="glass-card" style="max-width: 800px; margin: 0 auto;">
        <h2 class="mb-2">Mulai Diagnosis Baru</h2>
        <p class="mb-4">Upload foto kerusakan perangkat Anda atau gunakan kamera langsung untuk membantu Expert System kami menganalisis masalah.</p>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.2); border: 1px solid var(--danger); padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; color: #fff;">
                <ul style="list-style-type: none; margin: 0; padding: 0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.diagnosis.store') }}" method="POST" enctype="multipart/form-data" id="diagnosis-form">
            @csrf
            
            <div class="form-group mb-4">
                <label class="form-label" for="device_id">Kategori & Perangkat</label>
                <select name="device_id" id="device_id" class="form-control" required style="appearance: none; background-color: var(--bg-input);">
                    <option value="" disabled selected>Pilih Perangkat yang Rusak...</option>
                    @foreach($categories as $category)
                        <optgroup label="{{ $category->name }}">
                            @foreach($category->devices as $device)
                                <option value="{{ $device->id }}">{{ $device->name }} {{ $device->brand ? '('.$device->brand.')' : '' }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label class="form-label">Foto Kerusakan Utama</label>
                
                <div class="upload-tabs">
                    <button type="button" class="tab-btn active" id="tab-upload" onclick="switchTab('upload')">
                        <i class="fa-solid fa-file-arrow-up"></i> Upload File
                    </button>
                    <button type="button" class="tab-btn" id="tab-camera" onclick="switchTab('camera')">
                        <i class="fa-solid fa-camera"></i> Gunakan Kamera
                    </button>
                </div>

                <!-- Mode Upload File -->
                <div class="upload-area" id="upload-container">
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <p style="margin-bottom: 1rem;">Tarik foto ke sini atau klik untuk memilih file</p>
                    <input type="file" id="file_input" name="damage_photo" accept="image/jpeg,image/png,image/jpg,image/webp" style="width: 100%; max-width: 300px; margin: 0 auto; display: block;" required onchange="previewUpload(this)">
                    <img id="upload-preview" style="display: none; width: 100%; max-width: 300px; margin: 1rem auto 0; border-radius: 8px;">
                    <small class="text-muted mt-2 d-flex justify-center">Maksimal 5MB. Format: JPG, PNG, WEBP</small>
                </div>

                <!-- Mode Kamera -->
                <div class="upload-area" id="camera-container">
                    <video id="video-preview" autoplay playsinline></video>
                    <img id="photo-preview" alt="Hasil Foto">
                    <canvas id="canvas" style="display: none;"></canvas>
                    
                    <div class="d-flex justify-center gap-2 mt-2">
                        <button type="button" id="btn-start" class="btn btn-primary" onclick="startCamera()">Mulai Kamera</button>
                        <button type="button" id="btn-capture" class="btn btn-success" style="display: none;" onclick="takePhoto()">
                            <i class="fa-solid fa-camera"></i> Jepret Foto
                        </button>
                        <button type="button" id="btn-retake" class="btn btn-outline" style="display: none;" onclick="retakePhoto()">
                            <i class="fa-solid fa-rotate-right"></i> Ulangi
                        </button>
                    </div>
                    
                    <!-- Hidden input to store base64 image from camera -->
                    <input type="hidden" name="camera_image_base64" id="camera_image_base64">
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="form-label" for="additional_description">Deskripsi Singkat (Opsional)</label>
                <textarea name="additional_description" id="additional_description" class="form-control" rows="3" placeholder="Ceritakan sedikit tentang kerusakannya (Kapan terjadinya, apakah ada suara/bau tertentu)..."></textarea>
            </div>

            <div class="d-flex justify-between align-center mt-5">
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline">Batal</a>
                <button type="submit" class="btn btn-primary" id="submit-btn">Mulai Analisis <i class="fa-solid fa-arrow-right" style="margin-left: 0.5rem;"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentStream = null;
    let mode = 'upload'; // upload or camera

    function switchTab(selectedMode) {
        mode = selectedMode;
        
        // Update Buttons
        document.getElementById('tab-upload').classList.remove('active');
        document.getElementById('tab-camera').classList.remove('active');
        document.getElementById('tab-' + mode).classList.add('active');
        
        // Update Containers
        document.getElementById('upload-container').style.display = mode === 'upload' ? 'block' : 'none';
        document.getElementById('camera-container').style.display = mode === 'camera' ? 'flex' : 'none';
        
        // Handle Required Attributes & Camera Lifecycle
        const fileInput = document.getElementById('file_input');
        
        if (mode === 'camera') {
            fileInput.removeAttribute('required');
            // Suggest to start camera automatically if not already running
            if(!currentStream && document.getElementById('photo-preview').style.display !== 'block') {
                startCamera();
            }
        } else {
            stopCamera();
            if(!document.getElementById('camera_image_base64').value) {
                fileInput.setAttribute('required', 'required');
            }
        }
    }

    // --- File Upload Preview ---
    function previewUpload(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('upload-preview');
                img.src = e.target.result;
                img.style.display = 'block';
                
                // Clear camera data just in case
                document.getElementById('camera_image_base64').value = '';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // --- Camera Functions ---
    async function startCamera() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ 
                video: { facingMode: 'environment' } // Prefer back camera on mobile
            });
            
            currentStream = stream;
            const video = document.getElementById('video-preview');
            video.srcObject = stream;
            video.style.display = 'block';
            
            document.getElementById('photo-preview').style.display = 'none';
            document.getElementById('btn-start').style.display = 'none';
            document.getElementById('btn-capture').style.display = 'inline-block';
            document.getElementById('btn-retake').style.display = 'none';
            
            // Clear existing photo data
            document.getElementById('camera_image_base64').value = '';
            document.getElementById('file_input').removeAttribute('required');
            
        } catch (err) {
            console.error("Error accessing camera: ", err);
            alert("Tidak dapat mengakses kamera. Pastikan Anda telah memberikan izin akses kamera.");
        }
    }

    function takePhoto() {
        if (!currentStream) return;
        
        const video = document.getElementById('video-preview');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo-preview');
        
        // Set canvas dimensions to match video
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        // Draw video frame to canvas
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        // Get image data as base64 (JPEG, quality 0.8)
        const dataUrl = canvas.toDataURL('image/jpeg', 0.8);
        
        // Show photo preview
        photo.src = dataUrl;
        photo.style.display = 'block';
        video.style.display = 'none';
        
        // Save to hidden input
        document.getElementById('camera_image_base64').value = dataUrl;
        
        // Update Buttons
        document.getElementById('btn-capture').style.display = 'none';
        document.getElementById('btn-retake').style.display = 'inline-block';
        
        stopCamera();
    }

    function retakePhoto() {
        startCamera();
    }

    function stopCamera() {
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
            currentStream = null;
        }
    }

    // Clean up camera when navigating away
    window.addEventListener('beforeunload', stopCamera);
</script>
@endsection
