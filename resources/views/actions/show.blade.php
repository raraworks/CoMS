@extends('main')
@section('title', '| Apskatīt darbību: ')
@section('content')
  <div class="row">
    <div class="col-sm-4 col-sm-offset-2">
      <h1 class="display-1">
        {{ $action->title }}
      </h1>
      <hr />
    </div>
    <div class="col-sm-4 text-center well">
      <h3 class="display-5 text-muted">{{$action->client->title}}</h2>
      <h3>Termiņš: {{date('j.n.Y.', strtotime($action->due_date))}} <br> plkst. {{date('G:i', strtotime($action->due_time))}}</h3>
      <p>
        Apraksts: {{$action->content}}
      </p>
      <small>Ievietots: {{ date('j.n.Y.', strtotime($action->created_at)) }}</small>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-2 col-sm-offset-2">
    {{--  divos veidos var maršrutēt --}}
      {{-- <a href="/clients/{{$action->id}}/edit" class="btn btn-primary">Labot</a> --}}
      {!! Html::linkRoute('actions.edit', 'Labot', array($action->id), array('class'=>'btn btn-primary')) !!}
      {!! Form::open(['route' => ['actions.destroy', $action->id], 'method'=>'DELETE'])!!}
      {!!Form::submit('Dzēst', ['class'=>'btn btn-danger'])!!}
      {!!Form::close()!!}
      {!! Html::linkRoute('actions.index', ' Atpakaļ <<', array(), array('class'=>'link')) !!}
    </div>
  </div>
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
