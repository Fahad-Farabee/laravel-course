<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name' => 'Fahad Farabee',
            'subject' => 'CSE-Math'
        ]);
        Student::create([
            'name' => 'Siam Rahaman',
            'subject' => 'CSE-BIO'
        ]);
        Student::create([
            'name' => 'Rafsan Bin Alam',
            'subject' => 'CSE-Stats'
        ]);

        //using factory generated data
        \App\Models\Student::factory()->count(15)->create();
    }
}
