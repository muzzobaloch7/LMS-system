<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUsersSeeder extends Seeder
{
    public function run(): void
    {
        $adminUsers = [
            [
                'name' => 'Main Admin ',
                'email' => 'mainadmin.ug@admin.com',
                'password' => Hash::make('main'),
                'role' => 'mainadmin',
            ],
            [
                'name' => 'Id Card Admin',
                'email' => 'idcardadmin.ug@admin.com',
                'password' => Hash::make('card'),
                'role' => 'idcardadmin',
            ],
            [
                'name' => 'It Services Admin',
                'email' => 'itservices.ug@admin.com',
                'password' => Hash::make('it'),
                'role' => 'itservicesadmin',
            ],
            [
                'name' => 'Result Admin',
                'email' => 'resultadmin.ug@admin.com',
                'password' => Hash::make('result'),
                'role' => 'resultadmin',
            ],
        ];
        $staffs= [
            [
                'name' => 'Head Staff ',
                'email' => 'cshead@staff.ug.edu.pk',
                'password' => Hash::make('head'),
                'role' => 'staff'
            ],
            [
                'name' => 'Clerk Staff ',
                'email' => 'csclerk@staff.ug.edu.pk',
                'password' => Hash::make('clerk'),
                'role' => 'staff'
            ],
            [
                'name' => 'Lab Staff ',
                'email' => 'lab@staff.ug.edu.pk',
                'password' => Hash::make('lab'),
                'role' => 'staff'
            ],
        ];
        $students=[
            [
                'name' => 'Mahain',
                'email' => 's21bsit018@student.ug.edu.pk',
                'password' => Hash::make('it'),
                'role' => 'student'
            ],
            [
                'name' => 'Bisma',
                'email' => 's21bscom02@student.ug.edu.pk',
                'password' => Hash::make('commerce'),
                'role' => 'student'
            ],
            [
                'name' => 'Daniyal',
                'email' => 's21bsbba019@student.ug.edu.pk',
                'password' => Hash::make('bba'),
                'role' => 'student'
            ],
            [
                'name' => 'Azhar',
                'email' => 's22bsedu@student.ug.edu.pk',
                'password' => Hash::make('education'),
                'role' => 'student'
            ],
            [
                'name' => 'Mahnoor',
                'email' => 's23bsds@student.ug.edu.pk',
                'password' => Hash::make('datascience'),
                'role' => 'student'
            ],
            [
                'name' => 'Hassan',
                'email' => 's23bseng@student.ug.edu.pk',
                'password' => Hash::make('english'),
                'role' => 'student'
            ],
            [
                'name' => 'Saba',
                'email' => 's23bsche@student.ug.edu.pk',
                'password' => Hash::make('chemistry'),
                'role' => 'student'
            ],
            [
                'name' => 'Ganjatoon',
                'email' => 's23bseco@student.ug.edu.pk',
                'password' => Hash::make('economics'),
                'role' => 'student'
            ],
            
        ];
        foreach ($adminUsers as $admin) {
            User::create($admin);
        };
        foreach ($staffs as $staff) {
            User::create($staff);
        };
        foreach ($students as $student) {
            User::create($student);
        };
    }
}