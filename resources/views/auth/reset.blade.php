<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"></meta>
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/vertical.css') }}" />
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">Vertical</a>
    </div>
</div>
</nav>
<div class="container col-md-4 col-md-offset-4" >
<form method="POST" action="http://www.clusterix.com.ar/vertical/public/password/reset">
        <input type="hidden" name="token" value="{{ $token }}">
        {!! csrf_field() !!}
        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <h3 class="form-signin-heading">Cambiar Contraseña</h3>
        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Password" required=""/>            
        </div>
        <div class="form-group">
            <label for="password_confirmation">Reingrese Contraseña</label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Password" required=""/>            
        </div>
        <button class="btn btn-lg btn-primary btn-block"  name="Submit" type="Submit">Cambiar Contraseña</button>            
    </form>
</div>
<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</body>
</html>