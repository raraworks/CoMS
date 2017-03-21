@extends('main')
@section('title', '| Darbības ')
@section('content')
    <div class="row" id="topRow">
      <div class="col-sm-10 col-sm-offset-1" id="titleArea">
        <div class="col-sm-10">
          <h1 class="display-1">
            Darbības
          </h1>
        </div>
        <div class="col-sm-2 ash1">
          <a href="{{ route('actions.create') }}" class="btn btn-success pull-right" id="addBox"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>   Pievienot</a>
        </div>
        {{-- <form action="{{ route('actions.search') }}" method="get" id="searchForm">
        <div class="col-sm-2 ash1">
            <input type="text" name="term" placeholder="Meklēt" class="form-control" id="searchBox">
        </div>
        <div class="col-sm-1 ash1">
          <button type="submit" title="Meklēt" class="btn btn-primary" id="searchIcon"><span class="glyphicon glyphicon-search"></span></button>
        </div>
        </form> --}}
      </div>
    </div>
    <div class="row" id="contentRow">
      <table class="table table-striped text-center">
        <div class="col-sm-12">
          <thead class="thead">
            <tr>
              <th>Datums</th>
              <th>Laiks</th>
              <th>Klients</th>
              <th>Darbības veids</th>
              <th>Apraksts</th>
              <th>Statuss</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($actions as $action)
              <tr class="indextabula">
                <td>{{date('j.m.Y.', strtotime($action->due_date))}}</td>
                <td>{{ date('G:i', strtotime($action->due_time)) }}</td>
                <td>{{ $action->client->title }}</td>
                <td>{{ $action->title }}</td>
                <td>{{ Str::limit(strip_tags($action->content), 10, '...') }}</td>
                <td>
                  {{ $action->is_done ? 'Pabeigts' : 'Nav pabeigts' }}
                </td>
                <td>
                  <a class="btn btn-primary showButton" href="/actions/{{$action->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a>

                  <a class="btn btn-warning editButton" href="/actions/{{$action->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span> Labot</a>

                  <form class="deleteButton" action="{{ route('actions.destroy', ['action' => $action->id]) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method"  value="DELETE">
                    {{-- <input type="submit" name="name" value="Dzēst" class="ikonas"> --}}
                    <button type="submit" class="btn btn-danger" role="button"><span class=" glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </div>
      </table>
      {{-- pagination --}}
      <div class="text-center">
        {!! $actions->links() !!}
      </div>
    </div>
@endsection
