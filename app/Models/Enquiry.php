<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'photos' => 'array',
        'preferred_start_date' => 'date',
    ];
}
