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
              <th>Vārds</th>
              <th>E-pasts</th>
              <th>Lietotājs</th>
              <th>Administrators</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
              <tr class="indextabula">
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
@endsection
@section('title', 'Admin dashboard')
