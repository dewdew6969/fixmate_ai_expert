<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'name',
        'code',
        'description',
        'is_active',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class, 'rule_symptoms')
                    ->withPivot('expected_answer')
                    ->withTimestamps();
    }
}
