@extends('main')
@section('title', "| Izveidot jaunu darbību")
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Izveidot jaunu darbību</h1>
      <hr>
      {!! Form::open(['route' => 'actions.store', 'id'=>'createAction']) !!}
        {{Form::label('client_id', 'Klients: ')}}
        <select class="form-control" name="client_id">
          @foreach ($clients as $client)
            <option value="{{$client->id}}">{{$client->title}}</option>
          @endforeach
        </select>
        {{Form::label('title', 'Nosaukums: ')}}
        {{Form::text('title', null, array('class'=>'form-control')) }}
        {{Form::label('content', 'Apraksts: ')}}
        {{Form::textarea('content', null, array('class'=>'form-control')) }}
        {{Form::label('due_date', 'Atgādinājums: ')}}
        {{Form::text('due_date', 'DD.MM.GGGG', array('class'=>'form-control', 'id'=>'datetimepicker')) }}
        {{Form::text('due_time', 'SS:MM', array('class'=>'form-control', 'id'=>'datetimepicker1')) }}
        {{Form::submit('Izveidot', array('class' => 'btn btn-success'))}}
      {!! Form::close() !!}
    </div>
  </div>
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
  <link rel="stylesheet" href="/css/parsley.css">
  <link rel="stylesheet" href="/css/jquery.datetimepicker.min.css">
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.6.2/parsley.min.js" integrity="sha256-QKOftzbqahZaXS2amOh27JacZ6TbmT4TmGxNo4Jue4Y=" crossorigin="anonymous"></script>
  <script src="/js/jquery.datetimepicker.full.min.js"></script>
  <script type="text/javascript" src="/js/main.js">
  </script>
@endsection
