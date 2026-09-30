<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleSymptom extends Model
{
    use HasFactory;

    const UPDATED_AT = null; // Since migration only has created_at

    protected $fillable = [
        'rule_id',
        'symptom_id',
        'expected_answer',
    ];
}
