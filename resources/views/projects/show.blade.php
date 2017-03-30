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
      <h4 class="text-muted"><a href="{{ route('clients.show', ['id' => $project->client->id]) }}">{{$project->client->title}}</a> <div class="pull-right">
        Termiņš: {{date('j.n.Y.', strtotime($project->due_date))}} plkst. {{date('G:i', strtotime($project->due_time))}}
      </div></h4>
    </div>
  </div>
    <div class="col-sm-offset-1 col-sm-offset-right-1" style="display:flex; flex-wrap: wrap; align-items: flex-start;">
      <div id="sectionTitle">
        <h3>Projekta uzdevumi</h3>
      </div>
      <div id="taskRow">
      @foreach ($tasks as $task)
        <div class="col-sm-4 text-center">
          <div class="well">
            <h4>{{$task->task_name}}</h4>
            <p>
              {{ strip_tags($task->content) }}
            </p>
          </div>
        </div>
      @endforeach
      <div class="col-sm-4 text-center">
        <a href="#addTaskModal"data-toggle="modal"><div class="well">
          <span id="addTaskIcon" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
          <p class="text-muted">
            Pievieno jaunu projekta uzdevumu
          </p>
        </div>
        </a>
    </div>
    </div>
  </div>
    {{-- <div class="col-sm-10 col-sm-offset-1 well">
      <h3 class="display-5">Apraksts</h3>
      <hr>
      <div class="">
        {!!$project->content!!}
      </div>
      <div class="pull-right"><small>Ievietots: {{ date('j.n.Y.', strtotime($project->created_at)) }}</small>
    </div>
  </div> --}}
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
          <br>
        @endforeach

    </div>
    </div>
  @endif
  <!-- Add task modal -->
  <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pievienot jaunu uzdevumu projektam {{$project->project_name}}</h4>
        </div>
        <div class="modal-body">
          <form id="addTaskForm" action="{{ route('task.store', ['project' => $project->id]) }}" method="post">
            <div class="form-group">
              <label for="task_name">Lietotāja vārds:</label>
              <input class="form-control" type="text" name="task_name">
              <div id="error1">
              </div>
              <label for="due_date">Uzdevuma termiņš:</label>
              <div>
                <input class="form-control form-inline" id="datetimepicker" type="text" name="due_date" value="DD.MM.GGGG">
                <input class="form-control" id="datetimepicker1" type="text" name="due_time" value="SS:MM">
              </div>
              <label for="content">Apraksts</label>
              <textarea class="form-control" name="content"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aizvērt</button>
          <button id="addTaskButton" type="button" class="btn btn-primary">Pievienot</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('stylesheets')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.4/tinymce.min.js"></script>
  <script>tinymce.init({
    selector:'textarea',
    plugins: "link advlist",
    menubar: "false"
  });</script>
  <link rel="stylesheet" href="/css/clients.css">
  <link rel="stylesheet" href="/css/projectshow.css">
  <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">

@endsection
@section('scripts')
  <script src="/js/jquery.datetimepicker.full.min.js"></script>
  <script src="/js/deitpicker.js"></script>
  <script src="/js/projectshow.js">
  </script>

@endsection
