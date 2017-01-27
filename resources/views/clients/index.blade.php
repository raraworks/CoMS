@extends('main')
@section('title', '| Klienti ')
@section('content')
  <div class="row">
    <div class="row">
      <div class="col-md-10">
        <h1 class="display-1">
          Klienti
        </h1>
      </div>
      <div class="col-md-2 text-right block-div">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Pievienot</a>
      </div>
    </div>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>Klients</th>
            <th>Adrese</th>
            <th>Kontaktpersona</th>
            <th>Telefons</th>
            <th>Epasts</th>
            <th colspan="3">
              Darbības
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($clients as $client)
            <tr class="indextabula">
              <td>{{ $client->title }}</td>
              <td>{{ $client->address }}</td>
              <td>{{ $client->contact_name }}</td>
              <td>{{ $client->phone }}</td>
              <td>{{ $client->email }}</td>
              <td>{!! Html::linkRoute('clients.show', 'Skatīt', array($client->id), array('class'=>'btn btn-primary')) !!}</td>
              <td>{!! Html::linkRoute('clients.edit', 'Labot', array($client->id), array('class'=>'btn btn-success')) !!}</td>
              <td>{!! Html::linkRoute('clients.destroy', 'Dzēst', array($client->id), array('class'=>'btn btn-danger')) !!}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
@endsection
