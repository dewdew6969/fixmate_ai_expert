@extends('layouts.app')

@section('styles')
<style>
    .upload-area {
        border: 2px dashed var(--border-color);
        padding: 3rem 2rem;
        border-radius: 8px;
        text-align: center;
        background: rgba(6, 16, 30, 0.4);
        transition: var(--transition);
        position: relative;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .upload-area:hover {
        border-color: var(--primary);
        background: rgba(37, 99, 235, 0.05);
    }
    .upload-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        background: rgba(0,0,0,0.2);
        padding: 0.5rem;
        border-radius: 8px;
    }
    .tab-btn {
        flex: 1;
        padding: 0.875rem;
        background: transparent;
        border: 1px solid transparent;
        color: var(--text-muted);
        border-radius: 6px;
        cursor: pointer;
        transition: var(--transition);
        font-weight: 500;
        font-size: 0.95rem;
    }
    .tab-btn:hover {
        color: var(--text-main);
    }
    .tab-btn.active {
        background: var(--primary);
        color: #fff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }
    #camera-container {
        display: none;
    }
    #video-preview {
        width: 100%;
        max-width: 100%;
        border-radius: 8px;
        background: #000;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    #photo-preview {
        width: 100%;
        max-width: 100%;
        border-radius: 8px;
        display: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    /* Hide default file input but keep it functional */
    .custom-file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 2rem;
    }
    .form-control {
        width: 100%;
        padding: 1rem 1.25rem;
        background: rgba(6, 16, 30, 0.6);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-main);
        font-size: 1rem;
        transition: var(--transition);
        display: block;
        box-sizing: border-box;
    }
    .form-control:focus {
        border-color: var(--primary);
        background: rgba(6, 16, 30, 0.9);
        outline: none;
    }
    select.form-control {
        cursor: pointer;
    }
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5 mb-5">
    <div class="glass-card" style="max-width: 750px; margin: 0 auto; padding: 3rem;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <div style="display: inline-flex; align-items: center; justify-content: center; width: 60px; height: 60px; border-radius: 50%; background: rgba(37, 99, 235, 0.1); color: var(--primary); font-size: 1.5rem; margin-bottom: 1rem;">
                <i class="fa-solid fa-microchip"></i>
            </div>
            <h2 style="font-size: 2rem; margin-bottom: 0.5rem;">Mulai Diagnosis AI</h2>
            <p style="color: var(--text-muted); font-size: 1.05rem;">Sistem pakar kami membutuhkan data awal perangkat Anda.</p>
        </div>

        @if($errors->any())
            <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 2rem; color: #fff;">
                <ul style="list-style-type: none; margin: 0; padding: 0;">
                    @foreach($errors->all() as $error)
                        <li style="margin-bottom: 0.25rem;"><i class="fa-solid fa-circle-exclamation" style="margin-right: 0.5rem; color: var(--danger);"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.diagnosis.store') }}" method="POST" enctype="multipart/form-data" id="diagnosis-form">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="device_id" style="font-weight: 600; margin-bottom: 0.75rem;">1. Pilih Perangkat yang Rusak</label>
                <select name="device_id" id="device_id" class="form-control" required>
                    <option value="" disabled selected>-- Klik untuk memilih perangkat --</option>
                    @foreach($categories as $category)
                        <optgroup label="{{ $category->name }}" style="background: var(--bg-dark); color: var(--primary);">
                            @foreach($category->devices as $device)
                                <option value="{{ $device->id }}" style="color: var(--text-main);">{{ $device->name }} {{ $device->brand ? '('.$device->brand.')' : '' }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" style="font-weight: 600; margin-bottom: 0.75rem;">2. Bukti Visual Kerusakan (Foto)</label>
                
                <div class="upload-tabs">
                    <button type="button" class="tab-btn active" id="tab-upload" onclick="switchTab('upload')">
                        <i class="fa-solid fa-file-image"></i> Unggah File
                    </button>
                    <button type="button" class="tab-btn" id="tab-camera" onclick="switchTab('camera')">
                        <i class="fa-solid fa-camera"></i> Gunakan Kamera
                    </button>
                </div>

                <!-- Mode Upload File -->
                <div class="upload-area" id="upload-container">
                    <input type="file" id="file_input" name="damage_photo" accept="image/jpeg,image/png,image/jpg,image/webp" class="custom-file-input" required onchange="previewUpload(this)">
                    
                    <div id="upload-placeholder">
                        <i class="fa-solid fa-cloud-arrow-up" style="font-size: 3.5rem; color: var(--primary); margin-bottom: 1.5rem; opacity: 0.8;"></i>
                        <h3 style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--text-main);">Tarik & Lepas foto ke sini</h3>
                        <p style="color: var(--text-muted); margin-bottom: 0;">Atau klik untuk menelusuri file (Maks 5MB)</p>
                        <span class="btn btn-outline mt-3" style="pointer-events: none; padding: 0.5rem 1rem; font-size: 0.85rem;">Pilih File Foto</span>
                    </div>
                    
                    <img id="upload-preview" style="display: none; width: 100%; max-width: 400px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); z-index: 2; position: relative;">
                </div>

                <!-- Mode Kamera -->
                <div class="upload-area" id="camera-container" style="padding: 1.5rem;">
                    <video id="video-preview" autoplay playsinline></video>
                    <img id="photo-preview" alt="Hasil Foto">
                    <canvas id="canvas" style="display: none;"></canvas>
                    
                    <div class="d-flex justify-center gap-2 mt-4" style="width: 100%;">
                        <button type="button" id="btn-start" class="btn btn-primary" onclick="startCamera()" style="width: 100%;">
                            <i class="fa-solid fa-video"></i> Aktifkan Kamera
                        </button>
                        <button type="button" id="btn-capture" class="btn btn-success" style="display: none; width: 100%; background: var(--success); color: white;" onclick="takePhoto()">
                            <i class="fa-solid fa-camera-retro"></i> Jepret Foto
                        </button>
                        <button type="button" id="btn-retake" class="btn btn-outline" style="display: none; width: 100%;" onclick="retakePhoto()">
                            <i class="fa-solid fa-rotate-right"></i> Ulangi
                        </button>
                    </div>
                    
                    <!-- Hidden input to store base64 image from camera -->
                    <input type="hidden" name="camera_image_base64" id="camera_image_base64">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="additional_description" style="font-weight: 600; margin-bottom: 0.75rem;">3. Catatan Tambahan (Opsional)</label>
                <textarea name="additional_description" id="additional_description" class="form-control" placeholder="Contoh: AC meneteskan air sejak 2 hari yang lalu, dan ada suara bising saat dinyalakan..."></textarea>
            </div>

            <hr style="border: 0; height: 1px; background: var(--border-color); margin: 3rem 0;">

            <div class="d-flex justify-between align-center" style="gap: 1rem; flex-wrap: wrap;">
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline" style="min-width: 120px;">Batal</a>
                <button type="submit" class="btn btn-primary" id="submit-btn" style="flex: 1; padding: 1.25rem;">
                    Kirim & Mulai Analisis AI <i class="fa-solid fa-arrow-right" style="margin-left: 0.5rem;"></i>
                </button>
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
        document.getElementById('upload-container').style.display = mode === 'upload' ? 'flex' : 'none';
        document.getElementById('camera-container').style.display = mode === 'camera' ? 'flex' : 'none';
        
        const fileInput = document.getElementById('file_input');
        
        if (mode === 'camera') {
            fileInput.removeAttribute('required');
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

    function previewUpload(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('upload-placeholder').style.display = 'none';
                const img = document.getElementById('upload-preview');
                img.src = e.target.result;
                img.style.display = 'block';
                document.getElementById('camera_image_base64').value = '';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    async function startCamera() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ 
                video: { facingMode: 'environment' }
            });
            
            currentStream = stream;
            const video = document.getElementById('video-preview');
            video.srcObject = stream;
            video.style.display = 'block';
            
            document.getElementById('photo-preview').style.display = 'none';
            document.getElementById('btn-start').style.display = 'none';
            document.getElementById('btn-capture').style.display = 'block';
            document.getElementById('btn-retake').style.display = 'none';
            
            document.getElementById('camera_image_base64').value = '';
            document.getElementById('file_input').removeAttribute('required');
            
        } catch (err) {
            console.error("Error accessing camera: ", err);
            alert("Tidak dapat mengakses kamera. Pastikan browser Anda mengizinkan akses kamera.");
        }
    }

    function takePhoto() {
        if (!currentStream) return;
        
        const video = document.getElementById('video-preview');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo-preview');
        
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        const dataUrl = canvas.toDataURL('image/jpeg', 0.8);
        
        photo.src = dataUrl;
        photo.style.display = 'block';
        video.style.display = 'none';
        
        document.getElementById('camera_image_base64').value = dataUrl;
        
        document.getElementById('btn-capture').style.display = 'none';
        document.getElementById('btn-retake').style.display = 'block';
        
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

    window.addEventListener('beforeunload', stopCamera);
</script>
@endsection
