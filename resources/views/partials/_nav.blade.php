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
      <li class="{{Request::is('/') ? "active" : ""}}"><a href="/">{{trans('interface.dashboard')}}</a></li>
      <li class="{{Request::is('clients*') ? "active" : ""}}"><a href="/clients">{{trans('interface.clients')}}</a></li>
      <li class="{{Request::is('actions*') ? "active" : ""}}"><a href="/actions">{{trans('interface.actions')}}</a></li>
      <li class="{{Request::is('contacts*') ? "active" : ""}}"><a href="/contacts">{{trans('interface.contacts')}}</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      @if (Auth::user())
      <li><div class="user-area">
        Lietotājs: {{Auth::user()->name}}
      </span></li>
      <li>
        <div class="user-area">
          <form action="{{ url('/logout') }}" method="POST" style="display: inline-block;">
              {{ csrf_field() }}
              <button type="submit" class="ikona" role="button"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></button>
          </form>
        </div>
      </li>
      @endif
    </ul>
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
