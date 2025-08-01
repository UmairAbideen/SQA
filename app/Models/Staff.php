<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aircraftCert()
    {
        return $this->hasOne(AircraftCertifyingStaff::class);
    }

    public function componentCert()
    {
        return $this->hasOne(ComponentCertifyingStaff::class);
    }

    public function qualityAuditor()
    {
        return $this->hasOne(QualityAuditor::class);
    }

    public function qualifyingMechanic()
    {
        return $this->hasOne(QualifyingMechanic::class);
    }

    public function storeInspector()
    {
        return $this->hasOne(StoreQualityInspector::class);
    }

    public function labPersonnel()
    {
        return $this->hasOne(AuthorizedStandardLabPersonnel::class);
    }

    public function trainingSes()
    {
        return $this->hasOne(TrainingRecordSES::class);
    }





    public function auditor()
    {
        return $this->hasOne(AuthorizedAuditor::class);
    }

    public function trainingSa()
    {
        return $this->hasOne(TrainingRecordSa::class);
    }
}
