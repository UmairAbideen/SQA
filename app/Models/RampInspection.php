<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RampInspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'inspection_time',
        'aircraft_reg',
        'aircraft_type',
        'arrival_station',
        'destination',
        'flight_no',
        'bay_no',
        'inspection_ref_no',
        'inspection_type',
        'inspector',
        'status',
    ];

    public function rampInspectionFinding()
    {
        return $this->hasMany(RampInspectionFinding::class);
    }

    // public function Number()
    // {
    //     return $this->hasOneThrough(Contact::class,Company::class);
    // }
}
