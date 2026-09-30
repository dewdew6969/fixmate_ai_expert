<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'technician_id',
        'consultation_id',
        'booking_code',
        'service_date',
        'service_time',
        'service_address',
        'problem_description',
        'estimated_fee',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function repairReport()
    {
        return $this->hasOne(RepairReport::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
