<nav class="navbar navbar-default">
  <div class="container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">CoMS</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="{{Request::is('/') ? "active" : ""}}"><a href="/">Home</a></li>
      <li class="{{Request::is('clients') ? "active" : ""}}"><a href="/clients">Klienti</a></li>
      <li class="{{Request::is('actions') ? "active" : ""}}"><a href="/actions">Darbības</a></li>
      <li class="{{Request::is('contacts') ? "active" : ""}}"><a href="/contacts">Kontaktpersonas</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::user())
      <li>Lietotājs: {{Auth::user()->name}}</li>
      <li><form action="{{ url('/logout') }}" method="POST" style="display: inline-block;">
          {{ csrf_field() }}
          <input type="submit" name="submit" value="Iziet">
      </form></li>
      @endif
    </ul>
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
