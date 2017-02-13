@extends('main')
@section('title', '| Darbības ')
@section('content')
  <div class="row">
    <div class="row">
      <div class="col-md-10">
        <h1 class="display-1">
          Darbības
        </h1>
      </div>
      <div class="col-md-2 text-right block-div">
        <a href="{{ route('actions.create') }}" class="btn btn-primary">Pievienot</a>
      </div>
    </div>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>Datums</th>
            <th>Laiks</th>
            <th>Klients</th>
            <th>Darbība</th>
            <th>Apraksts</th>
            <th colspan="3">
              Darbības
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($actions as $action)
            <tr class="indextabula">
              <td>{{date('j.m.Y.', strtotime($action->due_date))}}</td>
              <td>{{ date('G:i', strtotime($action->due_time)) }}
              </td>
              <td>{{ $action->client->title }}</td>
              <td>{{ $action->title }}</td>
              <td>{{ $action->content }}</td>
              <td>{!! Html::linkRoute('actions.show', 'Skatīt', array($action->id), array('class'=>'btn btn-primary')) !!}</td>
              <td>{!! Html::linkRoute('actions.edit', 'Labot', array($action->id), array('class'=>'btn btn-success')) !!}</td>
              <td>{!! Form::open(['route' => ['actions.destroy', $action->id], 'method'=>'DELETE'])!!}
              {!!Form::submit('Dzēst', ['class'=>'btn btn-danger'])!!}
              {!!Form::close()!!}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{-- pagination --}}
      <div class="text-center">
        {!! $actions->links() !!}
      </div>
  </div>
@endsection
