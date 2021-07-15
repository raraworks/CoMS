@extends('main')
@section('title', '| Projekti ')
@section('content')
    <div class="row" id="topRow">
      <div class="col-sm-10 col-sm-offset-1" id="titleArea">
        <div class="col-sm-10">
          <h1 class="display-1">
            Projekti
          </h1>
        </div>
        <div class="col-sm-2 ash1">
          <a href="{{ route('projects.create') }}" class="btn btn-success pull-right" id="addBox"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>   Pievienot</a>
        </div>
      </div>
    </div>
    <div class="row" id="contentRow">
      <table class="table table-striped text-center">
        <div class="col-sm-12">
          <thead class="thead">
            <tr>
              <th>Klients</th>
              <th>Projekta nosaukums</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($projects as $project)
              <tr class="indextabula">
                <td>{{ $project->client->title }}</td>
                <td>{{ $project->project_name }}</td>
                <td>{{ Str::limit(strip_tags($project->content), 10, '...') }}</td>
                <td>
                  <a class="btn btn-primary showButton" href="/projects/{{$project->id}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Skatīt</a>

                  <a class="btn btn-warning editButton" href="/projects/{{$project->id}}/edit"><span class="glyphicon glyphicon-pencil ikonas" aria-hidden="true"></span> Labot</a>

                  <form class="deleteButton" action="{{ route('projects.destroy', ['project' => $project->id]) }}" method="POST">
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
      {{-- pagination --}}
      <div class="text-center">
        {!! $projects->links() !!}
      </div>
    </div>
@endsection
