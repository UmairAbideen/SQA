<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_no',
        'doc_name',
        'eff_date',
        'revision_no',
        'pdf_file',
    ];
}
