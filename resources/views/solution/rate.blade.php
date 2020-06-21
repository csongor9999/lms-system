@extends('layouts.app',[
  'user' => $user
])

@section('title', 'Feladat értékelése')
@section('navtitle', 'Feladat értékelése')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-2">
            <div class="card">
            <div class="card-header">{{$solution->task->subject['name']}} - {{$solution->task['name']}}</div>
                <h3 class="text-center">Feladat részletei</h3>
                <div class="card-body">
                    <details>
                        <summary>Feladat leírása</summary>
                        <p>{{$solution->task['description']}}</p>
                    </details>
                    <h5 class="card-title font-weight-bold">Megoldás szövege</h5>
                    <p class="card-text">{{$solution['solution_text']}}</p>
                    <h5 class="card-title font-weight-bold">Feltöltött fájl</h5>
                    @if($solution['filename'])
                    <a href={{route('solution.download',['filename' => $solution->filename])}} class="card-text">Letöltés</a>
                    @else
                    <a href={{route('solution.download',['filename' => $solution->filename])}} class="card-text">-</a>
                    @endif
                    <form method="POST" action="{{ route('solution.ratesolution',['id' => $solution->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="rating_point" class="col-md-4 col-form-label text-md-right">Értékelés (max: {{$solution->task['point']}} pont)</label>

                            <div class="col-md-6">
                                <input id="rating_point" type="number" min="0" max={{$solution->task['point']}} class="form-control @error('rating_point') is-invalid @enderror" name="rating_point" value="{{ old('rating_point') }}" required autocomplete="rating_point" autofocus>

                                @error('rating_point')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Szöveges értékelés</label>

                            <div class="col-md-6">
                                <textarea id="rating_text" class="form-control @error('rating_text') is-invalid @enderror" name="rating_text" value="{{ old('rating_text') }}" required autocomplete="rating_text" autofocus></textarea>

                                @error('rating_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Értékelés') }}
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