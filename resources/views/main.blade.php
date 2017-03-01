<!DOCTYPE html>
<html>
@include('partials._head')
@yield('stylesheets')
<body>
@include('partials._nav')
<div class="container-fluid">
  @include('partials._messages')
  @yield('content')
</div>
@include('partials._footer')
@include('partials._javascript')
@yield('scripts')
</body>
</html>
