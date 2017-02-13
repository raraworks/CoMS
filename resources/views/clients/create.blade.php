@extends('main')
@section('title', "| Izveidot jaunu klientu")
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Izveidot jaunu klientu</h1>
      <hr>
      {!! Form::open(['route' => 'clients.store', 'id'=>'createClient']) !!}
        {{Form::label('title', 'Nosaukums: ')}}
        {{Form::text('title', null, array('class'=>'form-control')) }}
        {{Form::label('address', 'Adrese: ')}}
        {{Form::textarea('address', null, array('class'=>'form-control')) }}
        {{Form::submit('Izveidot', array('class' => 'btn btn-success'))}}
      {!! Form::close() !!}
    </div>
  </div>
@endsection
@section('stylesheets')
  <link rel="stylesheet" href="/css/clients.css">
  <link rel="stylesheet" href="/css/parsley.css">
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.6.2/parsley.min.js" integrity="sha256-QKOftzbqahZaXS2amOh27JacZ6TbmT4TmGxNo4Jue4Y=" crossorigin="anonymous"></script>
@endsection
