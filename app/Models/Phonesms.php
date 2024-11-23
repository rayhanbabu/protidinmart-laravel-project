<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonesms extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'status',
        'verify_status',
        'otp',
        'date',
    ];
}
