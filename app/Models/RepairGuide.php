<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairGuide extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_id',
        'title',
        'description',
        'difficulty',
        'estimated_time',
        'risk_level',
        'required_tools',
        'safety_warning',
        'do_not_do',
        'is_active',
    ];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function repairSteps()
    {
        return $this->hasMany(RepairStep::class);
    }
}
