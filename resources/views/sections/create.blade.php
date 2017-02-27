@extends('main')
@section('title', "| Izveidot jaunu sadaļu")
@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-offset-3">
      <h1>Izveidot jaunu sadaļu klientam {{ $clientOne->title }}</h1>
        <form id="createSection" action="{{ route('clients.show', ['client' => $clientOne->id]) }}" method="post">
          <label for="section_name"> Sadaļas nosaukums: </label>
          <input type="text" name="section_name" class="form-control">
          <label for="content">Piezīme:</label>
          <textarea form="createSection" name="content" class="form-control"></textarea>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" name="name" value="Pievienot" class="btn btn-success">
        </form>
      {{-- {!! Form::open(['route' => 'clients.show', 'client'=>'{{$client->id}}']) !!}
        {{Form::label('section_name', 'Sadaļas nosaukums: ')}}
        {{Form::text('section_name', null, array('class'=>'form-control')) }}
        {{Form::label('content', 'Piezīme: ')}}
        {{Form::textarea('content', null, array('class'=>'form-control')) }}
        {{Form::submit('Izveidot', array('class' => 'btn btn-success'))}}
      {!! Form::close() !!} --}}
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
