@extends('main')
@section('content')
  <div class="row" id="topRow">
    <div class="col-sm-10 col-sm-offset-1" id="titleArea">
        <h1 class="display-1">
          Administratīvais panelis
        </h1>
    </div>
  </div>
  <div class="row col-sm-10 col-sm-offset-1">
    <div class="well nopadding">
      <table class="table table-striped text-center">
        <div class="col-sm-12">
          <thead class="thead">
            <tr>
              <th></th>
              <th>Vārds</th>
              <th>E-pasts</th>
              <th>Lietotājs</th>
              <th>Administrators</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr class="indextabula">
                <td>
                  <a href="/admin/search?id={{$user->id}}"><span class="glyphicon glyphicon-eye-open ikonas" aria-hidden="true"></span></a>
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><input type="checkbox" name="role_user" {{ $user->hasRole('user') ? 'checked' : '' }}></td>
                <td><input type="checkbox" name="role_admin" {{ $user->hasRole('admin') ? 'checked' : '' }}></td>
              </tr>
            @endforeach
          </tbody>
        </div>
      </table>
    </div>
  </div>
  {{-- <!-- Modal -->
  <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Meklēšana</h4>
        </div>
        <div class="modal-body">
          <form id="searchForm" action="{{ route('admin.search') }}" method="get">
            <div class="form-group">

              <input type="radio" name="type" value="action"><label for="action">Darbība</label>
              <input type="radio" name="type" value="client"><label for="client">Klients</label>
              <input type="radio" name="type" value="contact"><label for="contact">Kontaktpersona</label>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aizvērt</button>
          <button id="searchButton" type="button" class="btn btn-primary">Meklēt</button>
        </div>
      </div>
    </div>
  </div> --}}
@endsection
@section('title', 'Admin dashboard')
