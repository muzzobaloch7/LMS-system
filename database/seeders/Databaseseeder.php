<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Databaseseeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUsersSeeder::class,
            // ... other seeders ...
        ]);
    }
}