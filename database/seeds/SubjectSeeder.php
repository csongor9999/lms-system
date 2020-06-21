<?php

use App\Student;
use App\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Analízis 1',
            'description' => 'Analízis 1 tárgy leírása',
            'code' => 'IK-SSS111',
            'credit' => '4',
            'public' => '1',
            'teacher_id' => 1
        ]);

        Subject::create([
            'name' => 'Analízis 2',
            'description' => 'Analízis 2 tárgy leírása',
            'code' => 'IK-SSS112',
            'credit' => '5',
            'public' => '1',
            'teacher_id' => 2
        ]);


        $student1 = Student::where('id',1)->first();
        $student1->subjects()->attach(1);
        $student1->subjects()->attach(2);

        
    }
}
