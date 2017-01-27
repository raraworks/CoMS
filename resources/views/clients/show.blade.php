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
      <h3>Kontaktpersona: {{$client->contact_name}}</h3>
      <p>
        Telefons: {{$client->phone}}
      </p>
      <p>
        E-pasts: {{$client->email}}
      </p>
      <small>Ievietots: {{date('j.n.Y.', strtotime($client->created_at))}}</small>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 col-sm-offset-2">
    {{--  divos veidos var maršrutēt --}}
      <a href="/clients/{{$client->id}}/edit" class="btn btn-primary">Labot</a>
      {!! Html::linkRoute('clients.destroy', 'Dzēst', array($client->id), array('class'=>'btn btn-danger')) !!}
      {!! Html::linkRoute('clients.index', ' Atpakaļ <<', array(), array('class'=>'link')) !!}
    </div>
  </div>
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
