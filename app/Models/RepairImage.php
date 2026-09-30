<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairImage extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'repair_report_id',
        'image_path',
        'image_type', // before, process, after
    ];

    public function repairReport()
    {
        return $this->belongsTo(RepairReport::class);
    }
}
