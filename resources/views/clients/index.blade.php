@extends('main')
@section('title', '| Klienti ')
@section('content')
    <div class="row" id="topRow">
      <div class="col-sm-10 col-sm-offset-1" id="titleArea">
        <div class="col-sm-7">
          <h1 class="display-1">
            Klienti
          </h1>
        </div>
        <div class="col-sm-2 ash1">
          <a href="{{ route('clients.create') }}" class="btn btn-success pull-right" id="addBox"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>   Pievienot</a>
        </div>
        <form action="{{ route('clients.search') }}" method="get" id="searchForm">
        <div class="col-sm-2 ash1">
            <input type="text" name="term" placeholder="Meklēt" class="form-control" id="searchBox">
        </div>
        <div class="col-sm-1 ash1">
          <button type="submit" title="Meklēt" class="btn btn-primary" id="searchIcon"><span class="glyphicon glyphicon-search"></span></button>
        </div>
        </form>
      </div>
    </div>
    <div class="row" id="contentRow">
      <table class="table table-striped text-center">
        <div class="col-sm-12">
          <thead class="thead">
            <tr>
              <th>Klients</th>
              <th>Adrese</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($clients as $client)
              <tr class="indextabula">
                <td>{{ $client->title }}</td>
                <td>{{ $client->address }}</td>
                <td>
                  <a class="btn btn-primary showButton" href="/clients/{{$client->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a>

                  <a class="btn btn-warning editButton" href="/clients/{{$client->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span> Labot</a>

                  <form class="deleteButton" action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="POST">
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
        {!! $clients->links() !!}
      </div>
    </div>
@endsection
