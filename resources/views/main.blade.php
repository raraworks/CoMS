<!DOCTYPE html>
<html>
@include('partials._head')
{{-- @yield('stylesheets') --}}
<body>
@include('partials._nav')
@include('partials._messages')
<div class="container-fluid">
  @yield('content')
</div>
@include('partials._footer')
@include('partials._javascript')
@yield('scripts')
</body>
</html>
