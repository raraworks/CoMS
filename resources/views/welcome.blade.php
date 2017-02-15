@extends('main')
@section('content')
  <div class="row">
    <div class="col-md-6">
      <h1>Šodienas darbības</h1>
      <hr>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>Datums</th>
            <th>Laiks</th>
            <th>Klients</th>
            <th>Darbība</th>
            <th>Apraksts</th>
            <th>Darbības</th>
          </tr>
        </thead>
        <tbody>
          @foreach($actions as $action)
            {{-- @if (date('Y-m-d') == date('Y-m-d', strtotime($action->due_date))) --}}
              <tr class="indextabula">
                <td>{{ date('j.m.Y.', strtotime($action->due_date)) }}</td>
                <td>{{ date('G:i', strtotime($action->due_time)) }}
                </td>
                <td>{{ $action->client->title }}</td>
                <td>{{ $action->title }}</td>
                <td>{{ Str::limit($action->content, 20, '...') }}</td>
                <td>{!! Html::linkRoute('actions.show', 'Skatīt', array($action->id), array('class'=>'btn btn-primary')) !!}</td>
              </tr>
            {{-- @endif --}}
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <h1>Tuvākajā laikā</h1>
      <hr>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>Datums</th>
            <th>Laiks</th>
            <th>Klients</th>
            <th>Darbība</th>
            <th>Apraksts</th>
            <th>Darbības</th>
          </tr>
        </thead>
        <tbody>
          @foreach($actionsFuture as $actionFuture)
            @if (date('Y-m-d') < date('Y-m-d', strtotime($actionFuture->due_date)))
              <tr class="indextabula">
                <td>{{ date('j.m.Y.', strtotime($actionFuture->due_date)) }}</td>
                <td>{{ date('G:i', strtotime($actionFuture->due_time)) }}
                </td>
                <td>{{ $actionFuture->client->title }}</td>
                <td>{{ $actionFuture->title }}</td>
                <td>{{ Str::limit($actionFuture->content, 20, '...') }}</td>
                <td>{!! Html::linkRoute('actions.show', 'Skatīt', array($actionFuture->id), array('class'=>'btn btn-primary')) !!}</td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
      {{-- pagination --}}
      <div class="text-center">
        {!! $actionsFuture->links() !!}
      </div>
    </div>
  </div>

@endsection
@section('title', '| Welcome!')
