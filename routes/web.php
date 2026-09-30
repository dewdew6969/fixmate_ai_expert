<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;

// User Controllers
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\DiagnosisController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\MessageController as UserMessageController;
use App\Http\Controllers\User\RepairGuideController as UserRepairGuideController;

// Technician Controllers
use App\Http\Controllers\Technician\DashboardController as TechnicianDashboardController;
use App\Http\Controllers\Technician\BookingController as TechBookingController;
use App\Http\Controllers\Technician\RepairReportController;
use App\Http\Controllers\Technician\MessageController as TechMessageController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\DiagnosisController as AdminDiagnosisController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\SolutionController;
use App\Http\Controllers\Admin\RepairGuideController as AdminRepairGuideController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticationController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::get('register', [AuthenticationController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthenticationController::class, 'register']);
});

Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

// User Routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('diagnosis', DiagnosisController::class);
    Route::post('diagnosis/{id}/upload-image', [DiagnosisController::class, 'uploadImage'])->name('diagnosis.upload-image');
    Route::post('diagnosis/{id}/answer', [DiagnosisController::class, 'submitAnswer'])->name('diagnosis.answer');
    Route::get('diagnosis/{id}/result', [DiagnosisController::class, 'showResult'])->name('diagnosis.result');
    
    Route::resource('repair-guides', UserRepairGuideController::class)->only(['index', 'show']);
    Route::resource('bookings', UserBookingController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('messages', UserMessageController::class);
});

// Technician Routes
Route::middleware(['auth', 'role:technician'])->prefix('technician')->name('technician.')->group(function () {
    Route::get('/dashboard', [TechnicianDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('bookings', TechBookingController::class);
    Route::resource('repair-reports', RepairReportController::class);
    Route::resource('messages', TechMessageController::class);
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('categories', CategoryController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('symptoms', SymptomController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('diagnoses', AdminDiagnosisController::class);
    Route::resource('rules', RuleController::class);
    Route::resource('solutions', SolutionController::class);
    Route::resource('repair-guides', AdminRepairGuideController::class);
});
