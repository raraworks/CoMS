<div class="row" id="middleRow">
  <div class="col-sm-5 col-sm-offset-1">
    <div class="row virsraksts">
        <h3>Kontaktpersonas</h3>
    </div>
      @foreach ($contacts as $contact)
          <div class="col-sm-12 berns">
            <div class="col-sm-5 normalizee">
              <p> {{$contact->contact_name}} </p>
            </div>
            <div class="col-sm-2 normalizee">
              <p>
                Telefons: {{$contact->phone}}
              </p>
            </div>
            <div class="col-sm-5 normalizee">
              <p>
                E-pasts: {{$contact->email}}
              </p>
            </div>
          </div>
      @endforeach
  </div>
  <div class="col-sm-5">
    <div class="row virsraksts">
        <h3>Darbību vēsture</h3>
    </div>
        @foreach ($actions as $action)
        <div class="col-sm-12 berns">
          <div class="col-sm-4 normalizee">
            <p> {{ date('j.m.Y.', strtotime($action->due_date))}} </p>
          </div>
          <div class="col-sm-4 normalizee">
            <p>
              Telefons: {{$action->title}}
            </p>
          </div>
          <div class="col-sm-4 normalizee">
            <p>
              E-pasts: {{$action->content}}
            </p>
          </div>
        </div>
      @endforeach
      <div class="text-center">
        {!! $actions->links() !!}
      </div>
  </div>
</div>
