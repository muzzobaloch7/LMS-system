<?php

namespace App\Models;

use App\Models\StuPersonalRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentItCredentials extends Model
{
    use HasFactory;
    protected $fillable = [
        'username',
        'password',
        'user_id'
    ];

    // public function credential()
    // {
    //     return $this->many(StuPersonalRecord::class, 'user_id');
    // }
}
