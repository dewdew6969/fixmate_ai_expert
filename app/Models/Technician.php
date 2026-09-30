<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'description',
        'certificate',
        'identity_card',
        'skill_evidence',
        'portfolio_path',
        'service_fee',
        'service_area',
        'status',
        'rating',
        'completed_jobs',
        'is_verified',
        'is_available',
        'experience_years',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
