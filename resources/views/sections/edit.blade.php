@extends('main')
@section('title', "| Izlabot sadaļu")
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Izlabot sadaļu klientam {{ $clientOne->title }}</h1>
      <hr>
        <form id="editSection" action="{{ route('sections.update', ['client' => $clientOne->id, 'id' => $section->id]) }}" method="POST">
          <label for="section_name"> Sadaļas nosaukums: </label>
          <input type="text" name="section_name" class="form-control" value="{{$section->section_name}}">
          <label for="content">Piezīme:</label>
          <textarea form="editSection" name="content" class="form-control">{{$section->content}}</textarea>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method"  value="PUT">
          <input type="submit" name="name" value="Labot" class="btn btn-success">
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
