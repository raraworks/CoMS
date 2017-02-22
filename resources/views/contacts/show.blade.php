@extends('main')
@section('title')
Apskatīt kontaktu: {{$contact->contact_name}}
@endsection
@section('content')
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2">
      <h1 class="display-1">
        {{ $contact->contact_name }}
      </h1>
      <hr />
    </div>
    <div class="col-sm-4 text-center well">
      <h3>Klients: {{$contact->client->title}}</h3>
      <p>
        Telefons: {{$contact->phone}}
      </p>
      <p>
        E-pasts: {{$contact->email}}
      </p>
      <small>Ievietots: {{date('j.n.Y.', strtotime($contact->created_at))}}</small>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 col-sm-offset-2">
    {{--  divos veidos var maršrutēt --}}
      <a href="/contacts/{{$contact->id}}/edit" class="btn btn-primary">Labot</a>
      {!! Html::linkRoute('contacts.destroy', 'Dzēst', array($contact->id), array('class'=>'btn btn-danger')) !!}
      {!! Html::linkRoute('contacts.index', ' Atpakaļ <<', array(), array('class'=>'link')) !!}
    </div>
  </div>
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
