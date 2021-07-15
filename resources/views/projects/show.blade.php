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
      <h4 class="text-muted"><a href="{{ route('clients.show', ['client' => $project->client->id]) }}">{{$project->client->title}}</a></h4>
    </div>
  </div>
    <div class="col-sm-offset-1 col-sm-offset-right-1">
      <div id="sectionTitle">
        <h3>Projekta uzdevumi</h3>
        <hr>
      </div>
      <div id="taskRow" style="display:flex; flex-wrap: wrap; align-items: stretch;">
      @foreach ($tasks as $task)
        <div class="col-sm-4 text-center">
          <div class="well attachBox">
            <div class="controls">
              <small>{{ date('j.m.Y.', strtotime($task->due_date))}}</small>
              <a href="{{ route('task.destroy', ['task' => $task->id, 'project' => $project->id]) }}" class="deleteLink"><span class="glyphicon glyphicon-trash ikonas" aria-hidden="true"></span></a>
            </div>
            <h4>{{$task->task_name}}</h4>
            <p>
              {!!$task->content !!}
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
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <h3 class="display-5">Pielikumi</h3>
        <hr>
        <div id="attachRow" style="display:flex; flex-wrap: wrap; align-items: stretch;">
          @foreach ($att as $oneatt)
            <div class="col-sm-2 text-center">
              <div class="well attachBox">
                <div class="controls">
                  <a href="{{ route('files.project.destroy', ['filename' => $oneatt->filename]) }}" class="deleteAttachLink"><span class="glyphicon glyphicon-trash ikonas" aria-hidden="true"></span></a>
                </div>
                <a href="{{ route('files.project', ['filename' => $oneatt->filename]) }}" target="_blank">{{$oneatt->filename}}</a>
            </div>
            </div>
          @endforeach
          <div class="col-sm-2 text-center">
            <a href="#addAttachModal" data-toggle="modal">
              <div class="well">
                <span id="addAttachIcon" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                <p class="text-muted">
                Pievieno pielikumu
                </p>
              </div>
            </a>
          </div>
        </div>
    </div>
    </div>
  {{-- @endif --}}
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
              <label for="task_name">Uzdevuma nosaukums:</label>
              <input class="form-control" type="text" name="task_name">
              <div id="error1">
              </div>
              <label for="due_date">Uzdevuma termiņš:</label>
              <div>
                <input class="form-control form-inline" id="datetimepicker" type="text" name="due_date" value="DD.MM.GGGG">
                <input class="form-control" id="datetimepicker1" type="text" name="due_time" value="SS:MM">
              </div>
              <label for="content">Apraksts:</label>
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
  <!-- Add task modal END-->
  <!-- Add attach modal -->
  <div class="modal fade" id="addAttachModal" tabindex="-1" role="dialog" aria-labelledby="addAttachModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myAttachModalLabel">Pievienot jaunu pielikumu projektam {{$project->project_name}}</h4>
        </div>
        <div class="modal-body">
          <form id="addAttachForm" action="{{ route('projects.attach', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data">
            {{-- {{ route('project.store', ['project' => $project->id]) }} --}}
            <div class="form-group">
              <label for="attachments">Pielikumi:</label>
              <input id="file" type="file" name="file" multiple />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aizvērt</button>
          <button id="addAttachButton" type="button" class="btn btn-primary">Pievienot</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add attach modal END-->
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
