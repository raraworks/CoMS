@extends('main')
@section('title', "| Labot kontaktu")
@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Labot kontaktu</h1>
      <hr>
      {!! Form::model($contact, ['route' => ['contacts.update', $contact->id], 'method' => 'PUT']) !!}
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
        {{Form::submit('Labot', array('class' => 'btn btn-success'))}}
      {!! Html::linkRoute('contacts.show', 'Atpakaļ', array($contact->id), array('class'=>'btn btn-primary')) !!}
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
