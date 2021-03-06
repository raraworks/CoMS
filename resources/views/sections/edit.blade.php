@extends('main')
@section('title', "| Izlabot sadaļu")
@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-offset-3">
      <h1>Izlabot sadaļu klientam {{ $clientOne->title }}</h1>
        <form id="editSection" action="{{ route('sections.update', ['client' => $clientOne->id, 'id' => $section->id]) }}" method="POST" enctype="multipart/form-data">
          <label for="section_name"> Sadaļas nosaukums: </label>
          <input type="text" name="section_name" class="form-control" value="{{$section->section_name}}">
          <label for="content">Piezīme:</label>
          <textarea form="editSection" name="content" class="form-control">{{$section->content}}</textarea>
          <label for="attachments">Pielikumi:</label>
          <input type="file" name="attachments[]" multiple />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method"  value="PUT">
          <input type="submit" name="name" value="Labot" class="btn btn-success">
        </form>
    </div>
  </div>
@endsection
@section('stylesheets')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.4/tinymce.min.js"></script>
  <script>tinymce.init({
    selector:'textarea',
    plugins: "link",
    menubar: "false"
  });</script>
  <link rel="stylesheet" href="/css/clients.css">
  <link rel="stylesheet" href="/css/parsley.css">
  <link rel="stylesheet" href="/css/create.css">
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.6.2/parsley.min.js" integrity="sha256-QKOftzbqahZaXS2amOh27JacZ6TbmT4TmGxNo4Jue4Y=" crossorigin="anonymous"></script>
@endsection
