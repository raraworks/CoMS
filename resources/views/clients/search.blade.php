@extends('main')
@section('title')
 Meklēšana: {{$keyword}}
@endsection
@section('content')
  <div class="row">
    <div class="row">
      <div class="col-md-10">
        <h1 class="display-1">
          Meklēšanas rezultāti vaicājumam: {{$keyword}}
        </h1>
      </div>
      <div class="col-md-2 text-right block-div">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Pievienot</a>
      </div>
      <div class="col-md-2 text-right block-div">
        <form class="" action="{{ route('clients.search') }}" method="get">
          <input type="text" name="term" placeholder="Meklēt">
          <input type="submit" value="Meklēt">
        </form>
      </div>
    </div>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>Klients</th>
            <th>Adrese</th>
            <th colspan="3">
              Darbības
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($results as $result)
            <tr class="indextabula">
              <td>{{ $result->title }}</td>
              <td>{{ $result->address }}</td>
              <td>{!! Html::linkRoute('clients.show', 'Skatīt', array($result->id), array('class'=>'btn btn-primary')) !!}</td>
              <td>{!! Html::linkRoute('clients.edit', 'Labot', array($result->id), array('class'=>'btn btn-success')) !!}</td>
              <td>{!! Form::open(['route' => ['clients.destroy', $result->id], 'method'=>'DELETE'])!!}
              {!!Form::submit('Dzēst', ['class'=>'btn btn-danger'])!!}
              {!!Form::close()!!}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
  </div>
@endsection
