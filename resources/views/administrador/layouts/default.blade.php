<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="{{ URL::asset('favicon.ico') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('css/vertical.css') }}" />
  <title>Vertical - Sistema de Administración de Consorcios Online</title>
  @yield('header')
</head>
<body style="background-image: url({{ URL::asset('img/dashboard_02.jpg') }}); background-attachment: fixed;background-repeat: no-repeat;background-position: center; ">
  <div id="load"></div>
  @yield('modal')
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="{{ route('home') }}"><img src="{{ URL::asset('images/logos/icono2.png') }}" alt="Logo Vertical"></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar2" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!--<a class="navbar-brand" href="{{ route('home') }}">Vertical</a>-->
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        @if ( Auth::check() )
        <ul class="nav navbar-nav navbar-right" style="padding-right:10px;">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              Hola, {{ Auth::user()->nombre }}
              <strong></strong>
              <span class="glyphicon glyphicon-user" style="padding-left:5px;"></span>
              <span class="glyphicon glyphicon-chevron-down"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('perfil.show', Auth::user()->id) }}"><i class="glyphicon glyphicon-cog"></i> Cuenta</a></li>
              <li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-off"></i> Cerrar Sesion</a></li>
            </ul>
          </li>
        </ul>
        @endif
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar" id="navbar2" style="background-color:white;">
        <ul class="nav nav-sidebar filterable" style="background-color:white;">
          <li @if ( Request::is('*dashboard*') ) class="active" @endif><a href="{{ route('administrador.dashboard') }}"><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
          <li @if ( Request::is('users*') ) class="active" @endif><a href="{{ route('users.index') }}"><span class="glyphicon glyphicon-user"></span> Usuarios</a></li>
          <li @if ( Request::is('edificios*') ) class="active" @endif><a href="{{ route('edificios.index') }}"><span class="glyphicon glyphicon-stats"></span> Edificios</a></li>
          <li @if ( Request::is('reclamos*') ) class="active" @endif><a href="{{ route('reclamos.index') }}"><span class="glyphicon glyphicon-envelope"></span> Reclamos</a></li>
        </ul>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        @yield('content')
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/validator.js') }}"></script>
  <script type="text/javascript">
  document.onreadystatechange = function () {
    var state = document.readyState
    if (state == 'complete') {
           document.getElementById('interactive');
           document.getElementById('load').style.visibility="hidden";
    }
  }
  </script>
  @yield('footer')
</body>
</html>