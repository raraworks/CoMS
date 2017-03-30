@extends('main')
@section('title')
Apskatīt kontaktu: {{$contact->contact_name}}
@endsection
@section('content')

  <div class="row" id="topRow">
    <div class="col-sm-10 col-sm-offset-1" id="titleArea">
      <h1 class="display-1">
        {{ $contact->contact_name }} <a href="/contacts/{{$contact->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span></a>
        {!! Form::open(['route' => ['contacts.destroy', $contact->id], 'class'=>'ikonas', 'method'=>'DELETE'])!!}
        {{ Form::button('<span class="glyphicon glyphicon-remove ikonas" aria-hidden="true"></span>', ['class'=>'ikonas', 'role' => 'button', 'type' => 'submit'])}} {!!Form::close()!!}
      </h1>
      <h4 class="text-muted"> <a href="{{ route('clients.show', ['id' => $contact->client->id]) }}">{{$contact->client->title}}</a><div class="pull-right">
        <div class="phoneBox">
          <span class="glyphicon glyphicon-earphone"></span> {{$contact->phone}}
        </div> <a class="text-muted" href="mailto:{{$contact->email}}"> <span class="glyphicon glyphicon-envelope"></span> {{$contact->email}}</a>
      </div></h4>
    </div>
  </div>
  {{-- <div class="row">
    <div class="col-sm-10 col-sm-offset-1 well">
      <h3 class="display-5">Apraksts</h3>
      <hr>
      <div class="">
        {{$action->content}}
      </div>
      <div class="pull-right"><small>Ievietots: {{ date('j.n.Y.', strtotime($action->created_at)) }}</small>
    </div>
  </div>
  </div> --}}
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
