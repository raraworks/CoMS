<!DOCTYPE html>
<html>
@include('partials._head')
@yield('stylesheets')
<body>
@include('partials._nav')
<div class="container-fluid">
  @include('partials._messages')
  @yield('content')
  @include('partials._footer')
</div>
@include('partials._javascript')
@yield('scripts')
</body>
</html>
