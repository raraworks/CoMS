@foreach($allActions as $action)
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
