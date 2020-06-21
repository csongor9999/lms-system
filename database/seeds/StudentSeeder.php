<?php

use App\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'name' => 'Random Diak1',
            'email' => 'random@diak1.hu',
            'password' => Hash::make('123456789'),
            'role' => 'student'
        ]);

        Student::create([
            'name' => 'Random Diak2',
            'email' => 'random@diak2.hu',
            'password' => Hash::make('123456789'),
            'role' => 'student'
        ]);

        Student::create([
            'name' => 'Random Diak3',
            'email' => 'random@diak3.hu',
            'password' => Hash::make('123456789'),
            'role' => 'student'
        ]);
    }
}
