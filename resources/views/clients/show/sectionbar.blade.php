@if (count($client->sections))
  <div class="row" id='sectionRow'>
    <div class="col-sm-10 col-sm-offset-1">
      <div class="row">
        <div class="col-sm-12 headingi">
          <h3>Sadaļas</h3>
        </div>
      </div>
      @foreach ($sections as $section)
        <div class="well">
          <h4>{{ $section->section_name }}</h4>
          <div class="panel">
            <p>
              {{ $section->content }}
            </p>
          </div>
          {!! Html::linkRoute('sections.edit', 'Labot', array('client' => $client->id, 'id' => $section->id), array('class'=>'btn btn-default')) !!}
          <form id="deleteSection" action="{{ route('sections.destroy', ['client' => $client->id, 'id' => $section->id]) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method"  value="DELETE">
            <input type="submit" name="name" value="Dzēst" class="btn btn-danger">
          </form>

          {{-- {!! Form::open(['route' => ['sections.destroy', array('id'=>$section->id, 'client'=>$client->id)], 'method'=>'DELETE'])!!}
          {!!Form::submit('Dzēst', ['class'=>'btn btn-danger'])!!}
          {!!Form::close()!!} --}}
        </div>
      @endforeach
    </div>
  </div>
@endif
