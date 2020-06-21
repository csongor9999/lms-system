@extends('layouts.app')

@section('title', 'Főoldal')
@section('navtitle', 'Főoldal')

@section('content')

<div class="jumbotron text-center">
    <h1 class="display-4">Üdvözöllek az LMS rendszerben!</h1>
    <hr class="my-4">
    <h3>Az oldal adatai:</h3>

    <ul class="list-group">
            <p>Tanárok száma: <span class="badge badge-pill badge-dark">{{$teacherNum}}</span></p>
            <p>Diákok száma: <span class="badge badge-pill badge-dark">{{$studentNum}}</span></p>
    <p>Feladatok száma: <span class="badge badge-pill badge-dark">{{$taskNum}}</span></p>
    <p>Megoldások száma: <span class="badge badge-pill badge-dark">{{$solutionNum}}</span></p>
    </ul>
</div>

@endsection