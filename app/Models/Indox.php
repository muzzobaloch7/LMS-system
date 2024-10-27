<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indox extends Model
{
    use HasFactory;
    protected $fillable = [
        'reciever_id',
        'sender_name',
        'message',
        'status',
    ];
}
