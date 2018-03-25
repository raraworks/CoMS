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
        <div class="col-sm-2 ash1">
          <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#searchModal"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filtrēt</button>
        </div>
      </div>
    </div>
    <div class="row" id="contentRow">
      <table class="table table-striped text-center">
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
          <tbody id="tabula">
            @foreach($userActions as $userAction)
              <tr class="indextabula">
                <td>{{date('j.m.Y.', strtotime($userAction->due_date))}}</td>
                <td>{{ date('G:i', strtotime($userAction->due_time)) }}</td>
                <td>{{ $userAction->client->title }}</td>
                <td>{{ $userAction->title }}</td>
                <td>{{ Str::limit(strip_tags($userAction->content), 10, '...') }}</td>
                <td>
                  {{ $userAction->is_done ? 'Pabeigts' : 'Nav pabeigts' }}
                </td>
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
      </table>
      {{-- pagination --}}
      <div class="text-center">
        {!! $userActions->appends(request()->query())->links() !!}
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title" id="myModalLabel">Darbību filtrs</h3>
          </div>
          <div class="modal-body">
            <form id="searchForm" action="{{ route('admin.search') }}" method="get">
              <div class="form-group">
                <h4>Darbības veids</h4>
                <div>
                  <label><input type="checkbox" name="call" value="1" checked/> Zvans</label>
                  <label><input type="checkbox" name="meeting" value="1" checked/> Vizīte</label>
                  <label><input type="checkbox" name="offer" value="1" checked/> Piedāvājums</label>
                </div>
                <hr>
                <h4>Darbības statuss</h4>
                <label><input type="radio" class="status" name="status" value="0" /> Nav pabeigts</label>
                <label><input type="radio" class="status" name="status" value="1" /> Pabeigts</label>
                <hr>
                <h4>Klients</h4>
                <input class="form-control" type="text" name="client_name" placeholder="Klienta nosaukums">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Aizvērt</button>
            <button id="searchButton" type="button" class="btn btn-primary" data-dismiss="modal">Filtrēt</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      var url = "{{ route('admin.search')}}";
    </script>
@endsection
@section('scripts')
  <script src="/js/adminsearch.js">
  </script>
@endsection
