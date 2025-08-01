<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization',
        'audit_reference',
        'audit_type',
        'section',
        'location',
        'audit_date',
    ];

    public function finding()
    {
        return $this->hasMany(AuditFinding::class);
    }
}
