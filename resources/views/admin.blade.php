@extends('main')
@section('content')
  <div class="row" id="topRow">
    <div class="col-sm-10 col-sm-offset-1" id="titleArea">
      <div class="col-sm-10">
        <h1 class="display-1">
          Administratīvais panelis
        </h1>
      </div>
      <div class="col-sm-2 ash1">
        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addUserModal"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Pievienot lietotāju</button>
      </div>
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
              <th>
                
              </th>
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
                <td>
                  <a href="{{ route('user.destroy', $user->id) }}" class="deleteLink"><span class="glyphicon glyphicon-trash ikonas" aria-hidden="true"></span></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </div>
      </table>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Pievienot jaunu lietotāju</h4>
        </div>
        <div class="modal-body">
          <form id="addUserForm" action="{{ route('user.store') }}" method="post">
            <div class="form-group">
              <label>Lietotāja vārds: <input class="form-control" type="text" name="name"></label>
              <div class="name"></div>
              <label>E-pasta adrese: <input class="form-control" type="text" name="email"></label>
              <div class="email"></div>
              <label>Parole: <input class="form-control" type="password" name="password"></label>
              <div class="password"></div>
              <label>Parole atkārtoti: <input class="form-control" type="password" name="password2"></label>
              <div class="passError">
                <span>Paroles nesakrīt!</span>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Aizvērt</button>
          <button id="addButton" type="button" class="btn btn-primary">Pievienot</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script src="/js/admin.js">
  </script>

@endsection
@section('title', 'Admin dashboard')
