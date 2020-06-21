@extends('layouts.app',[
  'user' => $user
])

@section('title', 'Feladat részletei')
@section('navtitle', 'Feladat részletei')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 py-2">
            <div class="card">
            <div class="card-header">{{$subject['name']}} - {{$task['name']}}</div>
                <h3 class="text-center">Feladat részletei</h3>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Feladat Leírása</h5>
                    <p class="card-text">{{$task['description']}}</p>
                    <h5 class="card-title font-weight-bold">Pont</h5>
                    <p class="card-text">{{$task['point']}}</p>
                    <h5 class="card-title font-weight-bold">Feladat kezdete</h5>
                    <p class="card-text">{{$task['task_start']}}</p>
                    <h5 class="card-title font-weight-bold">Feladat vége</h5>
                    <p class="card-text">{{$task['task_end']}}</p>
                    <h5 class="card-title font-weight-bold">Feldat létrehozva</h5>
                    <p class="card-text">{{$task['created_at']}}</p>
                    <h5 class="card-title font-weight-bold">Feldat módosítva</h5>
                    <p class="card-text">{{$task['updated_at']}}</p>
                @if($user['role'] === 'teacher')
                <a class="btn btn-light" href="{{route('task.edit',$task->id)}}">Feladat módosítása</a>
                @endif
                </div>

                @if($user['role'] === 'teacher')
                <h3 class="text-center">Beadott Megoldások ({{$task->solutions->count()}}) - Értékelt megoldások ({{$solvedNum}})</h3>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Beadás dátuma</th>
                            <th scope="col">Diák neve</th>
                            <th scope="col">Diák e-mail címe</th>
                            <th scope="col">Kapott pont/Összes pont</th>
                            <th scope="col">Értékelés időpontja</th>
                            <th scope="col">Megoldás</th>
                          </tr>
                        </thead>
                        <tbody>
                    @foreach($task->solutions as $key => $solution)
                @if($solution['rating_point'])
                <tr style="border-left:10px solid green">
                @else
                <tr>
                @endif
                          <th scope="row">{{$key+1}}</th>
                        <td>{{$solution['created_at']}}</td>
                        <td>{{$solution->student['name']}}</td>
                        <td>{{$solution->student['email']}}</td>
                        @if($solution['rating_point'])
                        <td>{{$solution['rating_point']}}/{{$solution->task['point']}}</td>
                        <td>{{$solution['updated_at']}}</td>
                        <td><a class="btn btn-light disabled">Feladat értékelve</a></td>
                        @else
                        <td>-</td>
                        <td>-</td>
                        <td><a class="btn btn-light" href="{{route('solution.rate',$solution->id)}}">Feladat értékelése</a></td>
                        @endif
                          </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                @endif
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection