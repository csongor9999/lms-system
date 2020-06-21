@extends('layouts.app',[
  'user' => $user
])

@section('title', 'Feladat megoldása')
@section('navtitle', 'Feladat megoldása')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-2">
            <div class="card">
            <div class="card-header">{{$subject['name']}} - {{$task['name']}}</div>
                <h3 class="text-center">Feladat részletei</h3>
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Oktató</h5>
                    <p class="card-text">{{$subject->teacher()->get()->first()['name']}}</p>
                    @if($user['role'] === 'student')
                    <details open>
                        <summary>Feladat leírása</summary>
                        <p>{{$task['description']}}</p>
                    </details>
                    @endif
                    <h5 class="card-title font-weight-bold">Pont</h5>
                    <p class="card-text">{{$task['point']}}</p>
                    <h5 class="card-title font-weight-bold">Feladat kezdete</h5>
                    <p class="card-text">{{$task['task_start']}}</p>
                    <h5 class="card-title font-weight-bold">Feladat vége</h5>
                    <p class="card-text">{{$task['task_end']}}</p>
                    <h5 class="card-title font-weight-bold">Feladat Megoldása</h5>
                    <form method="POST" enctype="multipart/form-data" action="{{ route('task.solvetask',['id' => $task->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Megoldás szövege</label>

                            <div class="col-md-6">
                                <input id="solution_text" type="text" class="form-control @error('solution_text') is-invalid @enderror" name="solution_text" value="{{ old('solution_text') }}" required autocomplete="solution_text" autofocus>

                                @error('solution_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Megoldás fájl</label>
                            <div class="col-md-6">
                        <input type="file" name="file" class="form-control-file @error('file') is-invalid @enderror" id="file">
                        @error('file')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                        </div>
                            </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Megoldás beadása') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection