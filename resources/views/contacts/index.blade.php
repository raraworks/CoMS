@extends('main')
@section('title', '| Kontakti ')
@section('content')
  <div class="row">
    <div class="row">
      <div class="col-md-10">
        <h1 class="display-1">
          Kontakti
        </h1>
      </div>
      <div class="col-md-2 text-right block-div">
        <a href="{{ route('contacts.create') }}" class="btn btn-primary">Pievienot</a>
      </div>
    </div>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>Vārds un uzvārds</th>
            <th>Telefons</th>
            <th>E-pasts</th>
            <th>Klients</th>
            <th colspan="3">
              Darbības
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($contacts as $contact)
            <tr class="indextabula">
              <td>{{ $contact->contact_name }}</td>
              <td>{{ $contact->phone }}</td>
              <td>{{ $contact->email }}</td>
              <td>{{ $contact->client->title }}</td>
              <td>{!! Html::linkRoute('contacts.show', 'Skatīt', array($contact->id), array('class'=>'btn btn-primary')) !!}</td>
              <td>{!! Html::linkRoute('contacts.edit', 'Labot', array($contact->id), array('class'=>'btn btn-success')) !!}</td>
              <td>{!! Form::open(['route' => ['contacts.destroy', $contact->id], 'method'=>'DELETE'])!!}
              {!!Form::submit('Dzēst', ['class'=>'btn btn-danger'])!!}
              {!!Form::close()!!}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{-- pagination --}}
      <div class="text-center">
        {!! $contacts->links() !!}
      </div>
  </div>
@endsection
