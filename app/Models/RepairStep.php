<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'repair_guide_id',
        'step_number',
        'title',
        'description',
        'image',
        'warning',
    ];

    public function repairGuide()
    {
        return $this->belongsTo(RepairGuide::class);
    }
}
