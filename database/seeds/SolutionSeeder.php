<?php

use App\Solution;
use Illuminate\Database\Seeder;

class SolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $solution1 = Solution::create([
            'solution_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'filename' => 'test.png',
            'task_id' => 1,
            'student_id' => 1
        ]);
        
        $solution1->update(array('rating_point' => 1));
        $solution1->update(array('rating_text' => 'Nem megfelelő kép! Töltse fel újra megoldását!'));

        $solution1 = Solution::create([
            'solution_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'filename' => 'test2.png',
            'task_id' => 1,
            'student_id' => 1
        ]);

        $solution1->update(array('rating_point' => 4));
        $solution1->update(array('rating_text' => 'Helyes megoldás!'));

    }
}
