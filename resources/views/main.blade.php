<!DOCTYPE html>
<html>
@include('partials._head')
@yield('stylesheets')
<body>
@include('partials._nav')
<div class="container">
  @include('partials._messages')
  @yield('content')
  @include('partials._footer')
</div>
@include('partials._javascript')
<!-- pievieno scripts kurus vajag kurai lapai-->
  @yield('scripts')
</body>
</html>
