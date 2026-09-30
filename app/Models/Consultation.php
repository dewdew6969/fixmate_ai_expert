<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_id',
        'diagnosis_id',
        'consultation_code',
        'status',
        'result',
        'confidence',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function consultationImages()
    {
        return $this->hasMany(ConsultationImage::class);
    }

    public function consultationAnswers()
    {
        return $this->hasMany(ConsultationAnswer::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
