@extends('layouts.app', [
    'user' => $user
])

@section('title', 'Profil')
@section('navtitle', 'Profil')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
<div class="card">
    <div class="card-header">
        {{$user['name']}} Profilja
    </div>
    <div class="card-body">
      <h5 class="card-title">Adatok</h5>
      <p class="card-text"><b>Név:</b> {{$user['name']}}</p>
      <p class="card-text"><b>E-mail:</b> {{$user['email']}}</p>
      <p class="card-text"><b>Profil típusa:</b> {{$user['role'] === 'teacher' ? "Tanár" : 'Diák'}}</p>
    </div>
  </div>
</div>
</div>
</div>


@endsection