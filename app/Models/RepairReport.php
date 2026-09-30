<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'actual_diagnosis',
        'repair_action',
        'parts_used',
        'additional_cost',
        'repair_result',
        'notes',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function repairImages()
    {
        return $this->hasMany(RepairImage::class);
    }
}
