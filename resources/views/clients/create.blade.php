@extends('main')
@section('title', "| Izveidot jaunu klientu")
@section('content')
  <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
      <h1>Izveidot jaunu klientu</h1>
      {!! Form::open(['route' => 'clients.store', 'id'=>'createClient']) !!}
        {{Form::label('title', 'Nosaukums: ')}}
        {{Form::text('title', null, array('class'=>'form-control')) }}
        {{Form::label('address', 'Adrese: ')}}
        {{Form::textarea('address', null, array('class'=>'form-control')) }}
        <div class="show">
          <div class="btn btn-success" id="addBox"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></div>
          Pievienot kontaktpersonu
        </div>
        <div class="addContact">
          {{Form::label('contact_name', 'Vārds un uzvārds:* ')}}
          {{Form::text('contact_name', null, array('class'=>'form-control')) }}
          {{Form::label('phone', 'Telefons: ')}}
          {{Form::text('phone', null, array('class'=>'form-control')) }}
          {{Form::label('email', 'E-pasta adrese: ')}}
          {{Form::text('email', null, array('class'=>'form-control')) }}
          {{Form::label('position', 'Amats/atbildīgs par:')}}
          {{Form::text('position', null, array('class'=>'form-control')) }}
          <div class="show">
            * - obligātie lauki
          </div>
        </div>
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
  <script src="/js/createClient.js">
  </script>
@endsection
