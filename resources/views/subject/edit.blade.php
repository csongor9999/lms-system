@extends('layouts.app', [
    'user' => $teacher
])

@section('title', 'Tárgy szerkesztése')
@section('navtitle', 'Tárgy szerkesztése')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tárgy módosítása</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('subject.update', ['id' => $subject->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Tárgy neve</label>

                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$subject['name']}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Tárgy leírása</label>

                            <div class="col-md-6">
                                <input id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$subject['description']}}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">Tantárgyi kód</label>

                            <div class="col-md-6">
                                <input id="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{$subject['code']}}" required autocomplete="code">

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="credit" class="col-md-4 col-form-label text-md-right">Kreditérték</label>

                            <div class="col-md-6">
                                <input type="number" min="0" id="credit" type="credit" class="form-control @error('credit') is-invalid @enderror" name="credit" value="{{$subject['credit']}}" required autocomplete="credit">

                                @error('credit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tárgy módosítása') }}
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