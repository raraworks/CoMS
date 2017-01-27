@if (Session::has('success'))
  <div class="alert alert-success" role="alert">
    <strong>{{ Session::get('success') }}</strong>
  </div>
@endif
@if (count($errors) > 0)
  <div class="alert alert-danger" role="alert">
    <strong>@foreach($errors->all() as $error)
      <ul>
      {{ $error }}
      </ul>
    @endforeach</strong>
  </div>
@endif
