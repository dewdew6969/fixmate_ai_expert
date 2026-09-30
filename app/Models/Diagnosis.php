<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'name',
        'code',
        'description',
        'severity',
        'repairability',
        'requires_technician',
        'is_active',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }

    public function repairGuides()
    {
        return $this->hasMany(RepairGuide::class);
    }

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
