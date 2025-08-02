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
        'status',
    ];

    public function finding()
    {
        return $this->hasMany(AuditFinding::class);
    }


    public function getTotalFindingsAttribute()
    {
        return $this->finding->count();
    }

    public function getOpenFindingsAttribute()
    {
        return $this->finding->where('status', 'Open')->count();
    }

    public function getCloseFindingsAttribute()
    {
        return $this->finding->where('status', 'Close')->count();
    }
}
