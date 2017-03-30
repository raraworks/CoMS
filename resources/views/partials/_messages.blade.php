@if (Session::has('success'))
  <div class="alert alert-success" role="alert">
    <p>
      <strong>{{ Session::get('success') }}</strong>
    </p>
    @if (Session::has('success2'))
      <p>
        <strong>{{ Session::get('success2') }}</strong>
      </p>
    @endif
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
