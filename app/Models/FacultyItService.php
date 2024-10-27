<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyItService extends Model
{
    use HasFactory;
    protected $fillable=[
        'faculty_name',
        'faculty_designation',
        'department',
        'faculty_status',
        'faculty_id_no',
        'gender',
        'faculty_email',
        'faculty_contact_no',
        'hostel_name',
        'floor_no',
        'room_no',
        'it_services',
        'user_id',
        'accepted'
    ];
}
