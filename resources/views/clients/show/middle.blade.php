<div class="row" id="middleRow">
  <div class="row">
     <div class="col-sm-10 col-sm-offset-1">
       <button type="button" class="btn btn-default kontrole" id="kontakti">Kontaktpersonas</button>
       <button type="button" class="btn btn-default kontrole" id="darbibas">Darbības</button>
       <button type="button" class="btn btn-default kontrole" id="info">Informācija</button>
     </div>
  </div>
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1" id="infobox">
      {{-- Kontaktpersonu attēlošanas rāmis --}}
      <div class="kontakti" id="kontaktu-ramis">
        <div class="tabulasHedingi">
          <div class="col-xs-4">
            Vārds
          </div>
          <div class="col-xs-4">
            Telefons
          </div>
          <div class="col-xs-4">
            E-pasts
          </div>
        </div>
        @foreach ($contacts as $contact)
            <div class="col-xs-12 ieraksts">
              <div class="col-xs-4">
                <p> {{$contact->contact_name}} </p>
              </div>
              <div class="col-xs-4">
                <p>
                  {{$contact->phone}}
                </p>
              </div>
              <div class="col-xs-4">
                <p>
                  {{$contact->email}}
                </p>
              </div>
            </div>
        @endforeach
      </div>
      {{-- Darbību attēlošanas rāmis --}}
      <div class="darbibas" id="darbibu-ramis">
        <div class="tabulasHedingi">
          <div class="col-xs-4">
            Datums
          </div>
          <div class="col-xs-4">
            Laiks
          </div>
          <div class="col-xs-4">
            Darbība
          </div>
        </div>
        @foreach ($actions as $action)
          <div class="col-xs-12 ieraksts">
            <div class="col-xs-4">
              <p> {{ date('j.m.Y.', strtotime($action->due_date))}} </p>
            </div>
            <div class="col-xs-4">
              <p>
                {{ date('G:i', strtotime($action->due_time)) }}
              </p>
            </div>
            <div class="col-xs-4">
              <p>
                {{$action->title}}
              </p>
            </div>
          </div>
        @endforeach
      </div>
      {{-- Info attēlošanas rāmis --}}
      <div class="info" id="info-ramis">
        <div class="col-sm-3 pull-right">
          {!! Html::linkRoute('sections.create', 'Pievienot sadaļu', array('client' => $client->id), array('class'=>'btn btn-default')) !!}
        </div>
        @foreach ($sections as $section)
          <div class="col-xs-12">
            <h4>{{ $section->section_name }} <a href="/clients/{{$client->id}}/section/{{$section->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span></a>

            <form class="ikonas" action="{{ route('sections.destroy', ['client' => $client->id, 'id' => $section->id]) }}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_method"  value="DELETE">
              {{-- <input type="submit" name="name" value="Dzēst" class="ikonas"> --}}
              <button type="submit" class="ikonas" role="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            </form></h4>
            <div class="col-xs-12">
              <p>
                {{ $section->content }}
              </p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
