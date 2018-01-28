@extends('main')
@section('title', "| Izveidot jaunu kontaktu")
@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-offset-3">
      <h1>Izveidot jaunu kontaktu</h1>
      {!! Form::open(['route' => 'contacts.store', 'id'=>'createContact']) !!}
        {{Form::label('client_id', 'Klients: ')}}
        <select class="form-control" name="client_id">
          @foreach ($clients as $client)
          <option value="{{$client->id}}" {{ app('request')->input('client') == $client->id ? "selected" : "" }}>{{$client->title}}</option>
          @endforeach
        </select>
        {{Form::label('contact_name', 'Vārds un uzvārds: ')}}
        {{Form::text('contact_name', null, array('class'=>'form-control')) }}
        {{Form::label('phone', 'Telefons: ')}}
        {{Form::text('phone', null, array('class'=>'form-control')) }}
        {{Form::label('email', 'E-pasta adrese: ')}}
        {{Form::text('email', null, array('class'=>'form-control')) }}
        {{Form::label('position', 'Amats/atbildīgs par:')}}
        {{Form::text('position', null, array('class'=>'form-control')) }}
        {{-- {{Form::text('client_name', null, array('class'=>'form-control')) }} --}}
        {{Form::hidden('client', app('request')->query('client')) }}
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
