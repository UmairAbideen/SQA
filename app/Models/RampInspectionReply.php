<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RampInspectionReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'reply', // Reply content
        'reply_by', // Person who gave the reply
        'remarks', // Additional remarks
        'remarks_by', // Person who provided the remarks
        'attachment', // Attachment related to the reply
        'status', // Current status of the reply
    ];

    public function rampInspectionFinding()
    {
        return $this->belongsTo(RampInspectionFinding::class);
    }
}
