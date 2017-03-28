@extends('main')
@section('title')
Apskatīt projektu: {{$project->project_name}}
@endsection
@section('content')
  <div class="row" id="topRow">
    <div class="col-sm-10 col-sm-offset-1" id="titleArea">
      <h1 class="display-1">
        {{ $project->project_name }} <a href="/projects/{{$project->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span></a>
        {!! Form::open(['route' => ['projects.destroy', $project->id], 'class'=>'ikonas', 'method'=>'DELETE'])!!}
        {{ Form::button('<span class="glyphicon glyphicon-remove ikonas" aria-hidden="true"></span>', ['class'=>'ikonas', 'role' => 'button', 'type' => 'submit'])}} {!!Form::close()!!}
      </h1>
      <h4 class="text-muted">{{$project->client->title}} <div class="pull-right">
        Termiņš: {{date('j.n.Y.', strtotime($project->due_date))}} plkst. {{date('G:i', strtotime($project->due_time))}}
      </div></h4>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1 well">
      <h3 class="display-5">Apraksts</h3>
      <hr>
      <div class="">
        {!!$project->content!!}
      </div>
      <div class="pull-right"><small>Ievietots: {{ date('j.n.Y.', strtotime($project->created_at)) }}</small>
    </div>
  </div>
  </div>
  @if (count($att)>0)
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1 well">
        <h3 class="display-5">Pielikumi</h3>
        <hr>
        @foreach ($att as $oneatt)
          <a href="{{ route('files.project', ['filename' => $oneatt->filename]) }}" target="_blank">{{$oneatt->filename}}</a>
          <form class="ikonas" action="{{ route('files.project.destroy', ['filename' => $oneatt->filename]) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method"  value="DELETE">
            <button type="submit" class="ikonas" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          </form>
        @endforeach

    </div>
    </div>
  @endif
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
@endsection
