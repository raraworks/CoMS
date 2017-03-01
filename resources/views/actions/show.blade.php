@extends('main')
@section('title')
Apskatīt darbību: {{$action->title}}
@endsection
@section('content')
  <div class="row" id="topRow">
    <div class="col-sm-10 col-sm-offset-1" id="titleArea">
      <h1 class="display-1">
        {{ $action->title }} <a href="/actions/{{$action->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span></a>
        {!! Form::open(['route' => ['actions.destroy', $action->id], 'class'=>'ikonas', 'method'=>'DELETE'])!!}
        {{ Form::button('<span class="glyphicon glyphicon-remove ikonas" aria-hidden="true"></span>', ['class'=>'ikonas', 'role' => 'button', 'type' => 'submit'])}} {!!Form::close()!!}
      </h1>
      <h4 class="text-muted">{{$action->client->title}} <div class="pull-right">
        Termiņš: {{date('j.n.Y.', strtotime($action->due_date))}} plkst. {{date('G:i', strtotime($action->due_time))}}
      </div></h4>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1 well">
      <h3 class="display-5">Apraksts</h3>
      <hr>
      <div class="">
        {{$action->content}}
      </div>
      <div class="pull-right"><small>Ievietots: {{ date('j.n.Y.', strtotime($action->created_at)) }}</small>
    </div>
  </div>
  </div>
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
