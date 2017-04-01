<div class="col-sm-2 text-center">
  <div class="well attachBox">
    <div class="controls">
      <a href="{{ route('files.project.destroy', ['filename' => $oneatt->filename]) }}" class="deleteAttachLink"><span class="glyphicon glyphicon-trash ikonas" aria-hidden="true"></span></a>
    </div>
    <a href="{{ route('files.project', ['filename' => $oneatt->filename]) }}" target="_blank">{{$oneatt->filename}}</a>
</div>
</div>
