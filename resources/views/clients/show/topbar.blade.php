  <div class="row" id="clientRow">
    <div class="col-sm-10 col-sm-offset-1" id="clientTitle">
      <h1 class="display-1">
        {{ $client->title }} <a href="/clients/{{$client->id}}/edit"><span class="glyphicon glyphicon-pencil ikona" aria-hidden="true"></span></a>
        {!! Form::open(['route' => ['clients.destroy', $client->id], 'class'=>'deleteForma', 'method'=>'DELETE'])!!}
        {{ Form::button('<span class="glyphicon glyphicon-remove ikona" aria-hidden="true"></span>', ['class'=>'ikona', 'role' => 'button', 'type' => 'submit'])}} {!!Form::close()!!}
      </h1>
      <h4 class="display-5 text-muted">{{$client->address}}</h4>
    </div>
  </div>
