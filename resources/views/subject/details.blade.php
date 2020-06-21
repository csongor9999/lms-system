@extends('layouts.app',[
  'user' => $user
])

@section('title', 'Tárgy részletei')
@section('navtitle', 'Tárgy részletei')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-2">
            <div class="card">
            <div class="card-header">{{$subject['name']}}</div>
                <h3 class="text-center">Tárgy részletei</h3>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Leírás</h5>
                    <p class="card-text">{{$subject['description']}}</p>
                    <h5 class="card-title font-weight-bold">Tárgykód</h5>
                    <p class="card-text">{{$subject['code']}}</p>
                    <h5 class="card-title font-weight-bold">Kreditérték</h5>
                    <p class="card-text">{{$subject['credit']}}</p>
                    <h5 class="card-title font-weight-bold">Lérehozva</h5>
                    <p class="card-text">{{$subject['created_at']}}</p>
                    <h5 class="card-title font-weight-bold">Utolsó módosítás</h5>
                    <p class="card-text">{{$subject['updated_at']}}</p>
                    <h5 class="card-title font-weight-bold">Oktató:</h5>
                    <p class="card-text">{{$subject->teacher()->first()['name']}}</p>
                    <h5 class="card-title font-weight-bold">Oktató e-mail címe:</h5>
                    <p class="card-text">{{$subject->teacher()->first()['email']}}</p>
                @if($user['role'] === 'teacher')
                <a class="btn btn-danger" href="{{route('subject.delete',$subject->id)}}">Tárgy törlése</a>
                <a class="btn btn-light" href="{{route('subject.edit',$subject->id)}}">Tárgy módosítása</a>
                <a class="btn btn-light" href="{{route('task.create',$subject->id)}}">Feladat létrehozása</a>
                @endif
                </div>
                @if($user['role'] === 'teacher')
                  <h3 class="text-center">Feladatok ({{$tasks->count()}})</h3>
                @else
                <h3 class="text-center">Aktív feladatok ({{$activeTask}})</h3>
                @endif
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
                    @foreach($tasks->get() as $key => $task)
                          @if($user['role'] === 'student' && $task['task_start']<=date("Y-m-d") && $task['task_end']>date("Y-m-d"))
                              <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td><a href="{{route('task.solve',$task->id)}}">{{$task['name']}}</td>
                            <td>{{$task['point']}}</td>
                            <td>{{$task['task_start']}}</td>
                            <td>{{$task['task_end']}}</td>
                            @if($task->solutions->all('student_id',$user['id']))
                              <th>Megoldva</th>
                            @elseif($user['role'] === 'student')
                            <th>Nincs megoldva</th>
                            @endif
                            </tr>
                          @elseif($user['role'] === 'teacher')
                              @if($task['task_end']<date("Y-m-d"))
                              <tr style="background-color:#dc3545">
                            @elseif($task['task_start']<=date("Y-m-d") && $task['task_end']>date("Y-m-d"))
                              <tr style="background-color:#ffc107">
                            @elseif($user['role'] === 'teacher')
                              <tr style="background-color:#28a745">
                            @endif
                            <th scope="row">{{$key+1}}</th>
                            <td><a href="{{route('task.details',$task->id)}}">{{$task['name']}}</td>
                            <td>{{$task['point']}}</td>
                            <td>{{$task['task_start']}}</td>
                            <td>{{$task['task_end']}}</td>
                            </tr>
                          @endif


                    @endforeach
                    </tbody>
                    </table>
                </div>
            <h3 class="text-center">Jelentkezett diákok ({{$subject->students->count()}})</h3>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Név</th>
                            <th scope="col">E-mail cím</th>
                          </tr>
                        </thead>
                        <tbody>
                    @foreach($subject->students as $key => $student)
                          <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$student['name']}}</td>
                          <td>{{$student['email']}}</td>
                          </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection