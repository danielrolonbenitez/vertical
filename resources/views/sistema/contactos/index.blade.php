<html>
    <head>
        <title>Vertical - Sistema de Administracipon de Consorcios Online</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" type="image/png" href="{{ URL::asset('favicon.ico') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('assets/css/main.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/vertical.css') }}" />
        <link rel="stylesheet" href="css/contact.css" />
        <!--<link rel="stylesheet" href="{{ URL::asset('css/filter.css') }}" />-->
    </head>
    <body class="landing">
        <div id="page-wrapper">
        <!-- Header -->
        <header id="header">
            <a href="{{ route('home') }}"><img src="{{ URL::asset('images/logos/icono2.png') }}"></a>
            <h1><a href="home">Vertical</a> en sus hogares.</h1>
            <nav id="nav">
                <ul>
                    <li><a href="home">Inicio</a></li>
                    <li>
                        <a href="#" class="icon fa-angle-down">Secciones</a>
                        <ul>
                            <li><a href="#main">Principal</a></li>
                            <li><a href="#utilidades">Utilidades</a></li>
                        </ul>
                    </li>
                    <!--<li><a href="#ingresar" data-toggle="modal" class="button">Ingresar</a></li>
                    <li><a href="#registro" data-toggle="modal" class="button">Registrarse</a></li>-->
                </ul>
            </nav>
        </header>

 <!--begin form-->

                   <section id="main" class="container 75%">
                    <header id="uno">
                        <h2>Contactenos</h2>
                        <p>Su mensaje sera contestado a la brevedad</p>
                    </header>
                    <div class="box">
                        <form method="post" action="{{ action('ContactosController@store') }}">
                            <div class="row uniform 50%">
                                <div class="6u 12u(mobilep)">
                                    <input type="text" name="name" id="name" value="" placeholder="Nombre" />
                                </div>
                                <div class="6u 12u(mobilep)">
                                    <input type="email" name="email" id="email" value="" placeholder="Correo" />
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="12u">
                                    <input type="text" name="subject" id="subject" value="" placeholder="Asunto" />
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="12u">
                                    <textarea name="message" id="message" placeholder="Ingrese Su Mensaje" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="row uniform">
                                <div class="12u">
                                    <ul class="actions align-center">
                                        <li><input type="submit" value="Enviar Mensaje" /></li>
                                    </ul>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"><!--token de seguridad--->
                        </form>
                    </div>
                </section>
 <!--end form-->



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

<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="assets/js/jquery.dropotron.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.scrollgress.min.js"></script>
        <script type="text/javascript" src="assets/js/skel.min.js"></script>
        <script type="text/javascript" src="assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>