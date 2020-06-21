@extends('layouts.app',[
  'user' => $user
])

@section('title', 'Feladatlista')
@section('navtitle', 'Feladatlista')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-2">
            <div class="card">

                <h3 class="text-center">Aktív feladatok</h3>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Név</th>
                            <th scope="col">Pont</th>
                            <th scope="col">Tól</th>
                          <th scope="col">Ig</th>
                          @if($user['role'] === 'student')
                            <th scope="col">Megoldva</th>
                          @endif
                          </tr>
                        </thead>
                        <tbody>
                    @foreach($user->subjects as $key => $subject)
                     @foreach($subject->tasks as $key => $task)
                          @if($task['task_start']<=date("Y-m-d") && $task['task_end']>date("Y-m-d"))
                            <tr>
                          @endif
                          <th scope="row">{{$key+1}}</th>
                          @if($user['role'] === 'teacher')
                          <td><a href="{{route('task.details',$task->id)}}">{{$task['name']}}</td>
                          @else
                          <td><a href="{{route('task.solve',$task->id)}}">{{$task['name']}}</td>
                          @endif
                          <td>{{$task['point']}}</td>
                          <td>{{$task['task_start']}}</td>
                          <td>{{$task['task_end']}}</td>
                          @if($user['role'] === 'student' && $task['solution_text'] !== "")
                            <th>Megoldva</th>
                          @else
                          <th>Nincs megoldva</th>
                          @endif
                          </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection