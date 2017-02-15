@extends('main')
@section('title', "| Labot darbību")
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Labot darbību</h1>
      <hr>
      {!! Form::model($action, ['route' => ['actions.update', $action->id], 'method' => 'PUT']) !!}
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
      {{Form::text('due_date', $due_date, array('class'=>'form-control', 'id'=>'datetimepicker')) }}
      {{Form::text('due_time', $due_time, array('class'=>'form-control', 'id'=>'datetimepicker1')) }}
      {{Form::submit('Izveidot', array('class' => 'btn btn-success'))}}
      {!! Html::linkRoute('actions.show', 'Atpakaļ', array($action->id), array('class'=>'btn btn-primary')) !!}
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
