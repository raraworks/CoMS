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
