<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingRecordSES extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $table = 'training_record_ses';

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
