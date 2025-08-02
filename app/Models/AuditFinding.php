<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditFinding extends Model
{
    use HasFactory;

    protected $fillable = [
        'rule_reference',
        'attachment',
        'finding',
        'target_dates',
        'finding_number',
        'finding_level',
        'repeated_finding',
        'nature_of_finding',
        'validity_date',
        'auditor',
        'status',

    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }

    public function reply()
    {
        return $this->hasMany(AuditReply::class);
    }
}
