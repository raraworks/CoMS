@extends('main')
@section('title', "| Izveidot jaunu sadaļu")
@section('content')
  <div class="row">
    <div class="col-sm-6 col-md-offset-3">
      <h1>Izveidot jaunu sadaļu klientam {{ $clientOne->title }}</h1>
        <form id="createSection" action="{{ route('clients.show', ['client' => $clientOne->id]) }}" method="post" enctype="multipart/form-data">
          <label for="section_name"> Sadaļas nosaukums: </label>
          <input type="text" name="section_name" class="form-control">
          <label for="content">Piezīme:</label>
          <textarea form="createSection" name="content" class="form-control"></textarea>
          <label for="attachments">Pielikumi:</label>
          <input type="file" name="attachments[]" multiple />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" name="name" value="Pievienot" class="btn btn-success">
        </form>
    </div>
  </div>
@endsection
@section('stylesheets')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.4/tinymce.min.js"></script>
  <script>tinymce.init({
    selector:'textarea',
    plugins: "link advlist",
    menubar: "false"
  });</script>
  <link rel="stylesheet" href="/css/clients.css">
  {{-- <link rel="stylesheet" href="/css/parsley.css"> --}}
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.6.2/parsley.min.js" integrity="sha256-QKOftzbqahZaXS2amOh27JacZ6TbmT4TmGxNo4Jue4Y=" crossorigin="anonymous"></script>
@endsection
