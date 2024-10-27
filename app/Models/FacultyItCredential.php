<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyItCredential extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'mirco_username',
        'turnit_username',
        'password',
        'micro_password',
        'turnit_password',
        'user_id'
    ];
}
