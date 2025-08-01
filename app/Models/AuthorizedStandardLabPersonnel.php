<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizedStandardLabPersonnel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'authorized_standard_lab_personnel';

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
