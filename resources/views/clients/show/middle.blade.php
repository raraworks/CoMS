<div class="row" id="middleRow">
     <div class="col-sm-10 col-sm-offset-1" id="controlRow">
       <button type="button" class="btn kontrole" id="kontakti">Kontaktpersonas</button>
       <button type="button" class="btn kontrole" id="darbibas">Darbības</button>
       <button type="button" class="btn kontrole" id="info">Informācija</button>
     </div>
    <div class="col-sm-10 col-sm-offset-1" id="infobox">

      {{-- Kontaktpersonu attēlošanas rāmis --}}
      <div class="kontakti" id="kontaktu-ramis">
        <div class="well nopadding">
          <table class="table table-striped text-center">
            <div class="col-sm-12">
              <thead class="thead">
                <tr>
                  <th>Vārds</th>
                  <th>Telefons</th>
                  <th>E-pasts</th>
                  <th>Klients</th>
                </tr>
              </thead>
              <tbody>
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
              </tbody>
            </div>
          </table>
        </div>
      </div>

      {{-- Darbību attēlošanas rāmis --}}
      <div class="darbibas" id="darbibu-ramis">
        <div class="well nopadding">
          <table class="table table-striped text-center">
            <div class="col-sm-12">
              <thead class="thead">
                <tr>
                  <th>Datums</th>
                  <th>Laiks</th>
                  <th>Darbība</th>
                  <th>Apraksts</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($actions as $action)
                  <tr class="indextabula">
                    <td>{{ date('j.m.Y.', strtotime($action->due_date))}}</td>
                    <td>{{ date('G:i', strtotime($action->due_time)) }}</td>
                    <td>{{$action->title}}</td>
                    <td>{{ Str::limit($action->content, 20, '...') }}</td>
                    <td>
                      <a class="btn btn-primary showButton" href="/actions/{{$action->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a>

                      <a class="btn btn-warning editButton" href="/actions/{{$action->id}}/edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Labot</a>

                      <form class="deleteButton" action="{{ route('actions.destroy', ['action' => $action->id]) }}" method="POST">
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
        </div>
      </div>

      {{-- Info attēlošanas rāmis --}}
      <div class="info" id="info-ramis">
        <div class="col-sm-3 pull-right">
          {!! Html::linkRoute('sections.create', 'Pievienot sadaļu', array('client' => $client->id), array('class'=>'btn btn-default')) !!}
        </div>
        @foreach ($sections as $section)
            {{-- <div class="col-xs-12">
              <div class="well nopadding">
                <h4>{{ $section->section_name }} <a href="/clients/{{$client->id}}/section/{{$section->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span></a>

                <form class="ikonas" action="{{ route('sections.destroy', ['client' => $client->id, 'id' => $section->id]) }}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_method"  value="DELETE">
                  <button type="submit" class="ikonas" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                </form></h4>
                <div class="col-xs-12">
                  <p>
                    {{ $section->content }}
                  </p>
                </div>
              </div>
          </div> --}}
          <div class="col-sm-10 col-sm-offset-1 well">
            <h4 class="display-5">{{$section->section_name}}
              <div class="pull-right">
              <a href="/clients/{{$client->id}}/section/{{$section->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span></a>
              <form class="ikonas" action="{{ route('sections.destroy', ['client' => $client->id, 'id' => $section->id]) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method"  value="DELETE">
                <button type="submit" class="ikonas" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              </form>
            </div>
            </h4>
            <hr>
            <div class="">
              {{ $section->content }}
            </div>
            {{-- <div class="pull-right"><small>Ievietots: {{ date('j.n.Y.', strtotime($action->created_at)) }}</small> --}}
          </div>
          @endforeach
        </div>

      </div>
    </div>
</div>
