@extends('main')
@section('content')
  <div class="row col-md-12">
    <div class="col-md-12" id="todayTable">
      <h1>Šodienas darbības</h1>
      <hr>
      <table class="table text-center dash">
        <thead class="thead-inverse">
          <tr>
            <th>Datums</th>
            <th>Laiks</th>
            <th>Klients</th>
            <th>Darbības veids</th>
            <th>Apraksts</th>
            <th>Darbības</th>
          </tr>
        </thead>
        <tbody id="todayTbody">
          @foreach($actions as $action)
              @if ($action->is_done)
                <tr class="indextabula strikeTrough">
                @else
                <tr class="indextabula">
              @endif
                <td>{{ date('j.m.Y.', strtotime($action->due_date)) }}</td>
                <td class="taim">{{ date('G:i', strtotime($action->due_time)) }}
                </td>
                <td>{{ $action->client->title }}</td>
                <td>{{ $action->title }}</td>
                <td>{{ Str::limit(strip_tags($action->content), 10, '...') }}</td>
                {{-- <td></td> --}}
                <td class="isDoneButton">
                  <a class="btn btn-primary showButton" href="/actions/{{$action->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a><a class="btn btn-primary checkButton" data-iden="{{$action->id}}" data-isdone=""><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" ></span> Pabeigts</a>
                </td>
              </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-md-12" id="soonTable">
      <h1>Tuvākajā laikā</h1>
      <hr>
      <table class="table text-center">
        <thead class="thead-inverse">
          <tr>
            <th>Datums</th>
            <th>Laiks</th>
            <th>Klients</th>
            <th>Darbības veids</th>
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
                <td>{{ Str::limit(strip_tags($actionFuture->content), 10, '...') }}</td>
                <td><a class="btn btn-primary showButton" href="/actions/{{$actionFuture->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a></td>
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
    {{-- Aizgājušās darbības --}}
    <div class="row col-md-12">
    <div class="col-md-12" id="pastTable">
      <h1>Nesenās darbības</h1>
      <hr>
      <table class="table text-center">
        <thead class="thead-inverse">
          <tr>
            <th>Datums</th>
            <th>Laiks</th>
            <th>Klients</th>
            <th>Darbības veids</th>
            <th>Apraksts</th>
            <th>Statuss</th>
            <th>Darbības</th>
          </tr>
        </thead>
        <tbody>
          @foreach($actionsPast as $actionPast)
              <tr class="indextabula">
                <td>{{ date('j.m.Y.', strtotime($actionPast->due_date)) }}</td>
                <td>{{ date('G:i', strtotime($actionPast->due_time)) }}
                </td>
                <td>{{ $actionPast->client->title }}</td>
                <td>{{ $actionPast->title }}</td>
                <td>{{ Str::limit(strip_tags($actionPast->content), 10, '...') }}</td>
                <td>{{ $actionPast->is_done ? 'Pabeigts' : 'Nav pabeigts' }}</td>
                <td><a class="btn btn-primary showButton" href="/actions/{{$actionPast->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a></td>
              </tr>
          @endforeach
        </tbody>
      </table>
      {{-- pagination --}}
      <div class="text-center">
        {!! $actionsPast->links() !!}
      </div>
    </div>
  </div>
  <script>
    var actions = @php
      echo $subset;
    @endphp
  </script>
  <script>
    var token = '{{ Session::token() }}'
  </script>
@endsection
@section('scripts')
  <script src="/js/welcome.js"></script>
@endsection
@section('title', 'Dashboard')
