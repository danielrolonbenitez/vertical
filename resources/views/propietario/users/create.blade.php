@extends('propietario.layouts.default')

@section('content')
<div class="tab-content">
  @if (count($errors) > 0)
  <div class="alert-group">
    <div class="alert alert-danger alert-dimdissable">
      <button type="button" class="close" data-dimdiss="alert" aria-hidden="true">×</button>
      @foreach ($errors->all() as $error)
      {{ $error }}</br>
      @endforeach
    </div>
  </div>
  @endif
  <form method="POST" action="{{ route('users.store') }}" data-toggle="validator">
    {{ csrf_field() }}
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <h2 class="panel-title">Nuevo Usuario</h2>
      </div>
      <div class="panel-body col-xs-12">
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="nombre">Nombre</label> 
            <div class="col-md-8"> 
              <input autocomplete="off" required id="nombre" name="nombre" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="apellido">Apellido</label> 
            <div class="col-md-8">  
              <input autocomplete="off" required id="apellido" name="apellido" class="form-control" type="text" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="email">Email</label> 
            <div class="col-md-8"> 
            <input data-remote="{{ route('validate.usuarioemail') }}" data-remote-error="*Email registrado" required id="email" name="email" class="form-control" type="email" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label">Rol</label> 
            <div class="col-md-8">  
              <select class="form-control" id="rol_id" name="rol_id">
                @foreach ($roles as $rol)
                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                @endforeach
              </select>
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="password">Contraseña</label> 
            <div class="col-md-8"> 
              <input required id="password" name="password" class="form-control" type="password" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group col-md-6 has-feedback">
            <label class="col-md-4 control-label" for="password">Confirmar Contraseña</label> 
            <div class="col-md-8"> 
              <input data-match="#password" data-match-error="*Las contraseñas no coinciden" required id="password1" name="password1" class="form-control" type="password" data-error="*Campo obligatorio">
              <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="row">
        <button type="submit" class="pull-right btn btn-primary">Guardar</button>
        <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
      </div>
    </div>
  </form>
</div>
@stop