@extends('main')
@section('title', '| Apskatīt klientu: ')
@section('content')
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2">
      <h1 class="display-1">
        {{ $client->title }}
      </h1>
      <hr />
      <h3 class="display-5 text-muted">{{$client->address}}</h2>
    </div>
    <div class="col-sm-4 text-center well">
      @foreach ($contacts as $contact)
        <h3>Kontaktpersona: {{$contact->contact_name}}</h3>
        <p>
          Telefons: {{$contact->phone}}
        </p>
        <p>
          E-pasts: {{$contact->email}}
        </p>
      @endforeach
      <small>Ievietots: {{date('j.n.Y.', strtotime($client->created_at))}}</small>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 col-sm-offset-2">
    {{--  divos veidos var maršrutēt --}}
      <a href="/clients/{{$client->id}}/edit" class="btn btn-primary">Labot</a>
      {!! Form::open(['route' => ['clients.destroy', $client->id], 'method'=>'DELETE'])!!}
      {!!Form::submit('Dzēst', ['class'=>'btn btn-danger'])!!}
      {!!Form::close()!!}
      {!! Html::linkRoute('clients.index', ' Atpakaļ <<', array(), array('class'=>'btn btn-default')) !!}
    </div>
  </div>
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
