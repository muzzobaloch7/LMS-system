<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    use HasFactory;
    protected $table = 'student_records';

    protected $fillable = [
        'student_photo',
        'student_name',
        'relationship_status',
        'father_husband',
        'department',
        'duration',
        'student_id_no',
        'student_email',
        'student_dob',
        'student_bg',
        'student_contact_no',
        'student_emergency_contact_no',
        'student_address',
        'student_nic_no',
        'user_id',
        'accepted'
    ];
// protected $guarded=[];
public function isNewRecord() {
    // Define the logic to determine if the record is new
    return $this->created_at ; // Example logic
}
}
