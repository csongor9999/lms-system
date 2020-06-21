<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Random Oktato1',
            'email' => 'random@oktato1.hu',
            'password' => Hash::make('123456789'),
            'role' => 'teacher'
        ]);

        User::create([
            'name' => 'Random Oktato2',
            'email' => 'random@oktato2.hu',
            'password' => Hash::make('123456789'),
            'role' => 'teacher'
        ]);

        User::create([
            'name' => 'Random Oktato3',
            'email' => 'random@oktato3.hu',
            'password' => Hash::make('123456789'),
            'role' => 'teacher'
        ]);

        User::create([
            'name' => 'Random Diak1',
            'email' => 'random@diak1.hu',
            'password' => Hash::make('123456789'),
            'role' => 'student'
        ]);

        User::create([
            'name' => 'Random Diak2',
            'email' => 'random@diak2.hu',
            'password' => Hash::make('123456789'),
            'role' => 'student'
        ]);

        User::create([
            'name' => 'Random Diak3',
            'email' => 'random@diak3.hu',
            'password' => Hash::make('123456789'),
            'role' => 'student'
        ]);
    }
}
