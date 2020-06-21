@extends('layouts.app',[
  'user' => $teacher
])

@section('title', 'Saját tárgyaim')
@section('navtitle', 'Saját tárgyaim')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    @foreach($subjects->get() as $key => $subject)
    <div class="col-md-8 py-2">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><a href="{{route('subject.details', $subject['id'])}}">{{$subject['name']}}</a></h4>
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
          <td><a class="btn btn-primary" href="{{route('subject.publish',$subject->id)}}">{{$subject['public'] ? 'Publikálás visszavonása' : 'publikálás'}}</a></td>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection