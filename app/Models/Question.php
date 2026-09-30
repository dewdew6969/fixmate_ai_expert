<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'symptom_id',
        'question',
        'question_yes_label',
        'question_no_label',
        'order',
        'is_active',
    ];

    public function symptom()
    {
        return $this->belongsTo(Symptom::class);
    }

    public function consultationAnswers()
    {
        return $this->hasMany(ConsultationAnswer::class);
    }
}
