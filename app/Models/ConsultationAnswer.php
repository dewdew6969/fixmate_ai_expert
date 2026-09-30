<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationAnswer extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'consultation_id',
        'question_id',
        'answer',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
