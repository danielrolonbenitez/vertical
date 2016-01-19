<!DOCTYPE HTML>
<html>
<head>
  <title>Vertical - Sistema de Administracion de Consorcios Online</title>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" type="image/png" href="{{ URL::asset('favicon.ico') }}"/>
  <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
  <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="landing">
  <div id="page-wrapper">

    <!-- Header -->
    <header id="header" class="alt">
      <h1><a href="ttp://www.clusterix.com.ar/vertical/public/">Vertical</a> en sus hogares.</h1>

<!--<nav id="nav">
<ul>
<li><a href="#ingresar" data-toggle="modal" class="button">Ingresar</a></li>
<li><a href="#registro" data-toggle="modal" class="button">Registrarse</a></li>
</ul>
</nav>-->
</header>
<!-- Banner -->
<section id="banner">
  <img src="images/logos/vertical.png" height="auto" width="35%" >
  <p>Todas sus necesidades cubiertas en un solo lugar.</p>
  <ul class="actions">
    <li><a href="#ingresar" data-toggle="modal" class="button special">Ingresar</a></li>
    <li><a href="http://www.clusterix.com.ar/vertical/public/contacto" class="button">Contacto</a></li>
  </ul>
</section>
<!-- Main -->
<section id="main" class="container">
  <section class="box special">
    <header class="major">
      <h2>Vertical app es el control
        <br />
        para todas sus necesidades</h2>
        <p>Encuentre dentro del sistema la posibilidad de controlar distintas <br />
          alternativas sin perder su comodidad.</p>
        </header>
        <span class="image featured"><img src="images/pic01.jpg" alt="" /></span>
      </section>
    </section>
    <section id="utilidades" class="container">
      <section class="box special features">
        <div class="features-row">
          <section>
            <span class="icon major fa-mobile accent2"></span>
            <h3>Avisos y visualizaciones</h3>
            <p>Este informado constantemente de las novedades, reclamos, asambleas, informes y demás.</p>
          </section>
          <section>
            <span class="icon major fa-area-chart accent3"></span>
            <h3>Control de gastos</h3>
            <p>Dentro de las posibilidades de la aplicación los usuarios podrán controlar no solo sus expensas también incorporar otros impuestos para tener avisos de los mismos.</p>
          </section>
        </div>
        <div class="features-row">
          <section>
            <span class="icon major fa-calendar accent4"></span>
            <h3>Agenda general</h3>
            <p>Incorporé fechas de vencimiento de expensas, impuestos varios, reservas de espacios comunes entre otras opciones.</p>
          </section>
          <section>
            <span class="icon major fa-file-text-o accent5"></span>
            <h3>Visualización</h3>
            <p>Visualice e imprima sus liquidaciones de expensas en formato PDF y corrobore su historial de pagos.</p>
          </section>
        </div>
      </section>
    </section>
    <!-- Footer -->
    <footer id="footer">
      <ul class="icons">
        <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
        <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
        <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
        <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
        <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
        <li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
      </ul>
      <ul class="copyright">
        <li>&copy; Vertical. Todos los derechos reservados.</li>
      </ul>
    </footer>
  </div>
  <!-- Modal del Ingreso -->
  <div id="ingresar" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">x</button>
          <h3>Acceso al Sistema</h3>
        </div>
        <div class="modal-body">
          @if (isset($message))
          <div class="alert-group">
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p id="error">{{ $message }}</p>
            </div>
          </div>
          @endif
          {!! Form::open(array('route' => 'sessions.store')) !!}
          <p><input class="form-control" type="text" name="email" id="email" placeholder="Email"></p>
          <p><input class="form-control" type="password" name="password" placeholder="Password"></p>
          <button type="submit" class="btn btn-primary">Ingresar</button>
          <div class="pull-right">
          <a href="http://www.clusterix.com.ar/vertical/public/password/email">¿Olvido su contraseña?</a>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  <script type="text/javascript">
    $(window).load(function(){
      var error=document.getElementById("error").innerHTML;
      if ( error != null) {
        $('#ingresar').modal('show');
      }
    });
  </script>
</body>
</html>