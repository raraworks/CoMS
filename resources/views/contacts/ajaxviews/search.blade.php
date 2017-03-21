@foreach($contacts as $contact)
  <tr class="indextabula">
    <td>{{ $contact->contact_name }}</td>
    <td>{{ $contact->phone }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->client->title }}</td>
    <td>
      <a class="btn btn-primary showButton" href="/contacts/{{$contact->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a>

      <a class="btn btn-warning editButton" href="/contacts/{{$contact->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span> Labot</a>

      <form class="deleteButton" action="{{ route('contacts.destroy', ['contact' => $contact->id]) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method"  value="DELETE">
        {{-- <input type="submit" name="name" value="Dzēst" class="ikonas"> --}}
        <button type="submit" class="btn btn-danger" role="button"><span class=" glyphicon glyphicon-trash" aria-hidden="true"></span></button>
      </form>
    </td>
  </tr>
@endforeach
