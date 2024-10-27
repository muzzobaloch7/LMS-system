<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyRecord extends Model
{
    use HasFactory;

    protected $table = 'faculty_records';

    protected $fillable = [
        'staff_photo',
        'staff_name',
        'relationship_status',
        'father_husband',
        'department',
        'duration',
        'staff_id_no',
        'staff_email',
        'staff_dob',
        'staff_bg',
        'staff_contact_no',
        'staff_emergency_contact_no',
        'staff_address',
        'staff_nic_no',
        'user_id',
        'accepted'
    ];
}
