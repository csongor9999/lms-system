@extends('layouts.app', [
    'user' => $user
])

@section('title', 'Feladat szerkesztése')
@section('navtitle', 'Feladat szerkesztése')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">Feladat módosítása - {{$task['name']}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('task.edittask',['id' => $task->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Feladat neve</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $task['name'] }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Feladat leírása</label>

                            <div class="col-md-6">
                                <input id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $task['description'] }}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="point" class="col-md-4 col-form-label text-md-right">Feladat pontszáma</label>

                            <div class="col-md-6">
                                <input id="point" class="form-control @error('point') is-invalid @enderror" name="point" value="{{ $task['point']  }}" required autocomplete="point">

                                @error('point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="credit" class="col-md-4 col-form-label text-md-right">Határidő tól</label>

                            <div class="col-md-6">
                                <input type="date" min="0" id="task_start" type="task_start" class="form-control @error('task_start') is-invalid @enderror" name="task_start" value="{{ $task['task_start']  }}" required autocomplete="task_start">

                                @error('task_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="credit" class="col-md-4 col-form-label text-md-right">Határidő tól</label>

                            <div class="col-md-6">
                                <input type="date" min="0" id="task_end" type="task_end" class="form-control @error('task_end') is-invalid @enderror" name="task_end" value="{{ $task['task_end']  }}" required autocomplete="task_end">

                                @error('task_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Feladat módosítása') }}
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