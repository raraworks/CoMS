@extends('main')
@section('title', "| Izveidot jaunu kontaktu")
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Izveidot jaunu kontaktu</h1>
      <hr>
      {!! Form::open(['route' => 'contacts.store', 'id'=>'createContact']) !!}
        {{Form::label('contact_name', 'Vārds un uzvārds: ')}}
        {{Form::text('contact_name', null, array('class'=>'form-control')) }}
        {{Form::label('phone', 'Telefons: ')}}
        {{Form::text('phone', null, array('class'=>'form-control')) }}
        {{Form::label('email', 'E-pasta adrese: ')}}
        {{Form::text('email', null, array('class'=>'form-control')) }}
        {{Form::label('client_id', 'Klients: ')}}
        <select class="form-control" name="client_id">
          @foreach ($clients as $client)
            <option value="{{$client->id}}">{{$client->title}}</option>
          @endforeach
        </select>
        {{-- {{Form::text('client_name', null, array('class'=>'form-control')) }} --}}
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