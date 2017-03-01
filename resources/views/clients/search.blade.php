@extends('main')
@section('title')
 Meklēšana: {{$keyword}}
@endsection
@section('content')
  <div class="row" id="topRow">
    <div class="col-sm-10 col-sm-offset-1" id="titleArea">
      <div class="col-sm-7">
        <h1 class="display-1">
          Meklēšanas rezultāti: {{$keyword}}
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
          @foreach($results as $result)
            <tr class="indextabula">
              <td>{{ $result->title }}</td>
              <td>{{ $result->address }}</td>
              <td>
                <a class="btn btn-primary showButton" href="/clients/{{$result->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a>

                <a class="btn btn-warning editButton" href="/clients/{{$result->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span> Labot</a>

                <form class="deleteButton" action="{{ route('clients.destroy', ['client' => $result->id]) }}" method="POST">
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
  </div>
@endsection
