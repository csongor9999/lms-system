<?php

namespace App\Http\Controllers;

use App\Solution;
use App\Student;
use App\Task;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SolutionController extends Controller
{
    public function rate($id) {
        if(auth()->user()->role === 'teacher') {
            $user = Teacher::where('email',auth()->user()->email)->first();
        } else {
            $user = Student::where('email',auth()->user()->email)->first();
        }

        if($user['role'] === 'teacher') {
        $solution = Solution::where('id',$id)->first();
            return view('solution.rate', [
                'user' => $user,
                'solution' => $solution
            ]);
        } else {
            abort(401);
        }
    }

    public function rateSolution(Request $request,$id) {
        if(auth()->user()->role === 'teacher') {
            $user = Teacher::where('email',auth()->user()->email)->first();
        } else {
            $user = Student::where('email',auth()->user()->email)->first();
        }

        if($user['role'] === 'teacher') {
            $solution = Solution::where('id',$id)->first();
            $validated_data = $request->validate([
                'rating_point' => 'required',
            ]);
            $solution['rating_point'] = $request['rating_point'];
            $solution['rating_text'] = $request['rating_text'] ?? '';
            $solution->update($validated_data);

            return redirect()->route('task.details',$solution->task['id']);
        } else {
            abort(401);
        }
    }

    public function download($filename) {
        return response()->download(public_path('uploads/'.$filename));
    }
}