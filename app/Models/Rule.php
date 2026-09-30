<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'diagnosis_id',
        'rule_code',
        'confidence',
        'is_active',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'rule_symptoms')
                    ->withPivot('expected_answer')
                    ->withTimestamps();
    }
}
