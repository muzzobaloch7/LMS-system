<?php

namespace App\Models;

use App\Models\StuPersonalRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentItService extends Model
{
    use HasFactory;
    protected $fillable=[
        'registration_no',
        'student_name',
        'student_id_no',
        'department',
        'degree_program',
        'current_semester',
        'duration',
        'gender',
        'student_email',
        'student_contact_no',
        'hostel_name',
        'floor_no',
        'room_no',
        'user_id',
        'accepted'
    ];
    public function credentials()
    {
        return $this->hasMany(StudentItCredentials::class, 'user_id', 'user_id'); // Adjust foreign key and local key as necessary
    }
   
    public function isNewRecord() {
        // Define the logic to determine if the record is new
        return $this->created_at ; // Example logic
    }

//    public function user()
// {
//     return $this->belongsTo(User::class, 'id'); // Adjust the foreign key if necessary
// }
}