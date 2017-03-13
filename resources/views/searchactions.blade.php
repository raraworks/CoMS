@extends('main')
@section('title')
Skatīt lietotāja {{$user->name}} darbības
@endsection
@section('content')
    <div class="row" id="topRow">
      <div class="col-sm-10 col-sm-offset-1" id="titleArea">
        <div class="col-sm-10">
          <h1 class="display-1">
            Lietotāja {{$user->name}} darbības
          </h1>
        </div>
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
              <th>Darbība</th>
              <th>Apraksts</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($userActions as $userAction)
              <tr class="indextabula">
                <td>{{date('j.m.Y.', strtotime($userAction->due_date))}}</td>
                <td>{{ date('G:i', strtotime($userAction->due_time)) }}</td>
                <td>{{ $userAction->client->title }}</td>
                <td>{{ $userAction->title }}</td>
                <td>{{ Str::limit(strip_tags($userAction->content), 10, '...') }}</td>
                <td>
                  <a class="btn btn-primary showButton" href="/actions/{{$userAction->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a>

                  <a class="btn btn-warning editButton" href="/actions/{{$userAction->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span> Labot</a>

                  <form class="deleteButton" action="{{ route('actions.destroy', ['action' => $userAction->id]) }}" method="POST">
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
        {!! $userActions->appends(['id' => $user->id])->links() !!}
      </div>
    </div>
@endsection
