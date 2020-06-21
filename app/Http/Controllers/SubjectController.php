<?php

namespace App\Http\Controllers;

use App\Student;
use App\Subject;
use App\Task;
use App\Teacher;
use Illuminate\Http\Request;
class SubjectController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if(auth()->user()->role === 'teacher') {
            $teacher = Teacher::where('email',auth()->user()->email)->first();
            return view('subject.add', [
                'teacher' => $teacher
            ]);
        } else {
            abort(401);
        }
    }

    public function details($id) {
        $subject = Subject::find($id);
        $teacher = Teacher::where('email',auth()->user()->email)->first();
        $tasks = Task::where('subject_id',$id)->orderBy('task_end','DESC'); 
        $activeTask = 0;
        foreach($tasks->get() as $task) {
            if($task['task_start']<=date("Y-m-d") && $task['task_end']>date("Y-m-d")) {
                $activeTask++;
            }
        }

        if(auth()->user()->role === 'teacher') {
            $user = Teacher::where('email',auth()->user()->email)->first();
        } else {
            $user = Student::where('email',auth()->user()->email)->first();
        }


        return view('subject.details',[
            'user' => $user,
            'subject' => $subject,
            'tasks' => $tasks,
            'activeTask' => $activeTask
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|min:3',
            'code' => 'required|regex:/IK-[A-Z][A-Z][A-Z][0-9][0-9][0-9]/',
            'credit' => 'required'
        ]);

        $new_subject = new Subject;

        $new_subject['name'] = $request['name'];
        $new_subject['description'] = $request['description'];
        $new_subject['code'] = $request['code'];
        $new_subject['credit'] = $request['credit'];
        $new_subject['public'] = false;
        $new_subject['teacher_id'] = Teacher::all()->where('email',auth()->user()->email)->first()['id'];

        $new_subject->save();

        return redirect()->route('home');
    }

    public function publish($id) {
        $subject = Subject::where('id',$id)->first();
        boolval($subject['public']) === true ? $subject['public'] = false : $subject['public'] = true;
        $subject->save();
        return redirect()->route('home');
    }

    public function delete($id) {
        $teacher = Teacher::where('email',auth()->user()->email)->first();
        if($teacher->subjects()->find($id) !== null) {
            Subject::where('id',$id)->first()->delete();
            return redirect()->route('home');
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $teacher = Teacher::where('email',auth()->user()->email)->first();

        if($teacher!== null && $teacher->subjects()->find($id) !== null) {
            $subject = Subject::where('id',$id)->first();
            return view('subject.edit',[
                'teacher' => $teacher,
                'subject' => $subject
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $validated_data = $request->validate([
                'name' => 'required|min:3',
                'code' => 'required|regex:/IK-[A-Z][A-Z][A-Z][0-9][0-9][0-9]/',
                'credit' => 'required'
            ]);

            $subject = Subject::where('id',$id)->first();
            $subject->update($validated_data);
            return redirect()->route('subject.details',$id);
    }

    public function enroll() {
        $student = Student::where('email',auth()->user()->email)->first();
        $studentSubjectIDs = Subject::where('id',$student['id'])->pluck('id')->toArray(); 
        $studentSubjectIDs = $student->subjects()->get()->pluck('id')->toArray();
        $subjects = Subject::all()->toArray();
        $subjects = array_filter($subjects,function($subject) use ($studentSubjectIDs) {
            return !in_array($subject['id'],$studentSubjectIDs);
        });

        $subjectIDs = array_column($subjects,'id');

        $subjects = Subject::whereIn('id',$subjectIDs);

        return view('subject.enroll', [
            'student' => $student,
            'subjects' => $subjects
        ]);
    }

    public function enrollStudent($id) {
        $student = Student::where('email',auth()->user()->email)->first();
        $student->subjects()->attach($id);
        return redirect()->route('home');
    }

    public function cancelSubject($id) {
        $student = Student::where('email',auth()->user()->email)->first();
        $student->subjects()->detach($id);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
