<?php

use App\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'name' => 'Első házi feladat',
            'description' => 'Oldják meg az első öt feladatot a példatárból',
            'point' => '4',
            'task_start' => '2020-05-29',
            'task_end' => '2020-06-25',
            'subject_id' => 1
        ]);
    }
}
