@extends('main')
@section('title')
Labot klientu: {{$client->title}}
@endsection
@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-offset-3">
      <h1>Labot klientu</h1>
      {!! Form::model($client, ['route' => ['clients.update', $client->id], 'method' => 'PUT']) !!}
        {{Form::label('title', 'Nosaukums: ')}}
        {{Form::text('title', null, array('class'=>'form-control')) }}
        {{Form::label('address', 'Adrese: ')}}
        {{Form::textarea('address', null, array('class'=>'form-control')) }}
        {{Form::submit('Labot', array('class' => 'btn btn-success'))}}
      {!! Html::linkRoute('clients.show', 'Atpakaļ', array($client->id), array('class'=>'btn btn-primary')) !!}
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
