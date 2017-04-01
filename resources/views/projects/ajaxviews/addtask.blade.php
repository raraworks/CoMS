<div class="col-sm-4 text-center">
  <div class="well attachBox">
    <div class="controls">
      <small>{{ date('j.m.Y.', strtotime($task->due_date))}}</small>
      <a href="{{ route('task.destroy', ['task' => $task->id, 'project' => $task->project->id]) }}" class="deleteLink"><span class="glyphicon glyphicon-trash ikonas" aria-hidden="true"></span></a>
    </div>
    <h4>{{$task->task_name}}</h4>
    <p>
      {!! $task->content !!}
    </p>
  </div>
</div>
