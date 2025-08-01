<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RampInspectionFinding extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'category',
        'finding',
        'attachment',
        'status',
        'closed_by',
    ];

    public function rampInspection()
    {
        return $this->belongsTo(RampInspection::class);
    }

    public function rampInspectionReply()
    {
        return $this->hasOne(RampInspectionReply::class);
    }
}

