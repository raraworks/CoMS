@extends('main')
@section('title', "| Izveidot jaunu projektu")
@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-offset-3">
      <h1>Izveidot jaunu projektu</h1>
      {!! Form::open(['route' => 'projects.store', 'id'=>'createProject', 'files' => true]) !!}
        {{Form::label('client_id', 'Klients: ')}}
        <select class="form-control" name="client_id">
          @foreach ($clients as $client)
            <option value="{{$client->id}}">{{$client->title}}</option>
          @endforeach
        </select>
        {{Form::label('project_name', 'Projekta nosaukums: ')}}
        {{Form::text('project_name', null, array('class'=>'form-control')) }}
        {{Form::label('attachments', 'Saistītie faili: ')}}
        {{Form::file('attachments[]', array('multiple'=>true))}}
        {{Form::submit('Izveidot', array('class' => 'btn btn-success'))}}
      {!! Form::close() !!}
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
