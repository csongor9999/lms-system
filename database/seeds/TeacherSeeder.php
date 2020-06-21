<?php

use App\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'name' => 'Random Oktato1',
            'email' => 'random@oktato1.hu',
            'password' => Hash::make('123456789'),
            'role' => 'teacher'
        ]);

        Teacher::create([
            'name' => 'Random Oktato2',
            'email' => 'random@oktato2.hu',
            'password' => Hash::make('123456789'),
            'role' => 'teacher'
        ]);

        Teacher::create([
            'name' => 'Random Oktato3',
            'email' => 'random@oktato3.hu',
            'password' => Hash::make('123456789'),
            'role' => 'teacher'
        ]);
    }
}
