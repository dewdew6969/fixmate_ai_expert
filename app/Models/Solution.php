<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnosis_id',
        'solution',
        'requires_technician',
        'order',
    ];

    public function diagnosis()
    {
        return $this->belongsTo(Diagnosis::class);
    }
}
