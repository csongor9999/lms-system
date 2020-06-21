<?php

namespace App\Http\Controllers;

use App\Solution;
use App\Student;
use App\Subject;
use App\Task;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class TaskController extends Controller
{

    public function create($id) {
        $teacher = Teacher::where('email',auth()->user()->email)->first();
        $subject = Subject::where('id',$id)->first();
        return view('task.add',[
            'subjectId' => $id,
            'teacher' => $teacher,
            'subject' => $subject
        ]);
    }

    public function store(Request $request, $id) {
        $teacher = Teacher::where('email',auth()->user()->email)->first();
        $subject = Subject::where('id',$id)->first();
        
        $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
            'point' => 'integer',
        ]);

        $new_task = new Task();

        $new_task['name'] = $request['name'];
        $new_task['description'] = $request['description'];
        $new_task['point'] = $request['point'];
        $new_task['task_start'] = $request['task_start'];
        $new_task['task_end'] = $request['task_end'];
        $new_task['subject_id'] = $id; 

        $new_task->save();

        return redirect()->route('subject.details',['id' => $id]);
    }

    public function details($id) {
        $task = Task::where('id',$id)->first();
        $subject = $task->subject()->get()->first();

        if(auth()->user()->role === 'teacher') {
            $user = Teacher::where('email',auth()->user()->email)->first();
        } else {
            $user = Student::where('email',auth()->user()->email)->first();
        }

        $solvedNum = 0;
        foreach($task->solutions as $solution) {
            if($solution['rating_point'] !== "") {
                $solvedNum++;
            }
        }

        return view('task.details',[
            'user' => $user,
            'subject' => $subject,
            'task' => $task,
            'solvedNum' => $solvedNum
        ]);
    }

    public function edit($id) {
        $task = Task::where('id',$id)->first();
        $subject = $task->subject()->get()->first();

        if(auth()->user()->role === 'teacher') {
            $user = Teacher::where('email',auth()->user()->email)->first();
        } else {
            $user = Student::where('email',auth()->user()->email)->first();
        }

        return view('task.edit',[
            'user' => $user,
            'subject' => $subject,
            'task' => $task
        ]);
    }

    public function editTask(Request $request, $id) {
        $task = Task::where('id',$id)->first();
        
        $validated_data = $request->validate([
            'name' => 'required|min:5',
            'description' => 'required',
            'point' => 'integer',
            'task_start' => 'date',
            'task_end' => 'date'
        ]);

        $task->update($validated_data);

        return redirect()->route('task.details',['id' => $id]);
    }

    public function solve($id) {
        $task = Task::where('id',$id)->first();
        $subject = $task->subject()->get()->first();

        if(auth()->user()->role === 'teacher') {
            $user = Teacher::where('email',auth()->user()->email)->first();
        } else {
            $user = Student::where('email',auth()->user()->email)->first();
        }

        
        return view('task.solve',[
            'user' => $user,
            'subject' => $subject,
            'task' => $task
        ]);
    }

    public function solveTask(Request $request,$id) {
        $task = Task::where('id',$id)->first();

        $validated_data = $request->validate([
            'solution_text' => 'required',
        ]);

        $filename = '';
        if($request['file']) {
            $filename = time().'.'.$request->file->extension();  
            $request->file->move(public_path('uploads'), $filename);
        }
        

        if(auth()->user()->role === 'teacher') {
            $user = Teacher::where('email',auth()->user()->email)->first();
        } else {
            $user = Student::where('email',auth()->user()->email)->first();
        }

        $newSolution = new Solution();

        $newSolution['solution_text'] = $request['solution_text'];
        $newSolution['filename'] = $filename;
        $newSolution['task_id'] = $id;
        $newSolution['student_id'] = $user['id'];

        $newSolution->save();

        
        return redirect()->route('task.details',['id' => $id]);
    }

    public function list() {

        if(auth()->user()->role === 'teacher') {
            $user = Teacher::where('email',auth()->user()->email)->first();
        } else {
            $user = Student::where('email',auth()->user()->email)->first();
        }

        return view('task.list',[
            'user' => $user
        ]);
    }
}
