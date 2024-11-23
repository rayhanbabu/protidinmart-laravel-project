<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'emailmd5',
        'status',
        'password',
        'email_verify_status',
        'member_category',
        'otp',
    ];

}
