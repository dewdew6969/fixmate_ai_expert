<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationImage extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'consultation_id',
        'image_path',
        'description',
        'ai_analysis_result',
    ];

    protected $casts = [
        'ai_analysis_result' => 'array',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}
