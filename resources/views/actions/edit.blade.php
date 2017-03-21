@extends('main')
@section('title')
Labot darbību: {{$action->title}}
@endsection
@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-offset-3">
      <h1>Labot darbību</h1>
      {!! Form::model($action, ['route' => ['actions.update', $action->id], 'method' => 'PUT']) !!}
      {{Form::label('client_id', 'Klients: ')}}
      <select class="form-control" name="client_id">
        <option value="{{ $action->client->id }}" selected>
          {{$action->client->title}}
        </option>
        @foreach ($clients as $client)
          <option value="{{$client->id}}">{{$client->title}}</option>
        @endforeach
      </select>
      {{Form::label('title', 'Veids: ')}}
      {{Form::select('title', array('Zvans' => 'Zvans', 'Vizīte' => 'Vizīte', 'Piedāvājums' => 'Piedāvājums'), null, array('class'=>'form-control')) }}
      {{Form::label('due_date', 'Atgādinājums: ')}}
      <div>
        {{Form::text('due_date', $due_date, array('class'=>'form-control', 'id'=>'datetimepicker')) }}
        {{Form::text('due_time', $due_time, array('class'=>'form-control', 'id'=>'datetimepicker1')) }}
      </div>
      {{Form::label('content', 'Apraksts: ')}}
      {{Form::textarea('content', null, array('class'=>'form-control')) }}
      {{Form::submit('Labot', array('class' => 'btn btn-success'))}}
      {!! Html::linkRoute('actions.show', 'Atpakaļ', array($action->id), array('class'=>'btn btn-primary')) !!}
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
  <link rel="stylesheet" href="/css/parsley.css">
  <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">
  <link rel="stylesheet" href="/css/create.css">
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.6.2/parsley.min.js" integrity="sha256-QKOftzbqahZaXS2amOh27JacZ6TbmT4TmGxNo4Jue4Y=" crossorigin="anonymous"></script>
  <script src="/js/jquery.datetimepicker.full.min.js"></script>
  <script type="text/javascript" src="/js/deitpicker.js">
  </script>
@endsection
