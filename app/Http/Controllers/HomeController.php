<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function guest()
    {

        $subjects = Subject::all();

        $taskNum = 0;
        $solutionNum = 0;

        foreach($subjects as $subject) {
            foreach($subject->tasks as $task) {
                $taskNum++;
                $solutionNum+=$task->solutions->count();
            }
        } 


        return view('home.guest', [
            'teacherNum' => Teacher::all()->count(),
            'studentNum' => Student::all()->count(),
            'taskNum' => $taskNum,
            'solutionNum' => $solutionNum
        ]);
    }

    public function viewProfile($role, $id)
    {

        if ($role === 'teacher') {
            $profile = Teacher::find($id);
        } else {
            $profile = Student::find($id);
        }

        if ($profile !== null) {
            return view('home.profile', [
                'user' => $profile
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (auth()->user()->role) {
            case 'teacher':
                $teacher = Teacher::all()->where('email',auth()->user()->email)->first();
                return view('home.teacher', [
                    'teacher' => $teacher,
                    'subjects' => $teacher->subjects()
                ]);
                break;
            case 'student':
                $student = Student::all()->where('email',auth()->user()->email)->first();
                return view('home.student', [
                    'student' => $student,
                    'subjects' => $student->subjects()
                ]);
                break;
        }
    }
}
