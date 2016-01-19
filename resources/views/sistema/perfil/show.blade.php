@extends('sistema.layouts.default')

@section('modal')
<div class="modal" id="UserDeleteModal" tabindex="-1" role="dialog" aria-labelledby="UserDeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      {!! Form::model('1', array('id' => 'DeleteForm', 'method' => 'DELETE', 'route' => array('perfil.destroy', Auth::user()->id))) !!}
      {!! csrf_field() !!}
      <div class="modal-header text-center">
        ¿Esta seguro que desea realizar esta operación?
      </div>
      <div class="modal-body text-center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        {!! Form::submit('Aceptar', array('class' => 'btn btn-primary col-md-offset-1')) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="modal" id="UserPasswordModal" tabindex="-1" role="dialog" aria-labelledby="UserPasswordModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        {!! Form::model('1', array('id' => 'PasswordChangeForm', 'method' => 'PUT', 'route' => array('perfil.password', Auth::user()->id), 'data-toggle'=>'validator')) !!}
        {!! csrf_field() !!}
        <div class="panel-primary">
          <div class="panel-heading">
            <h5 style="font-size:18px;margin: 0px 0px 0px 0px;">Cambiar Contraseña</h5>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-sm-12 has-feedback">
                <label class="col-sm-6 control-label" for="password">Contraseña Actual</label> 
                <div class="col-sm-6">  
                  <input autocomplete="off" required id="password" name="password" class="form-control" type="password" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12 has-feedback">
                <label class="col-sm-6 control-label" for="password1">Nueva Contraseña Actual</label> 
                <div class="col-sm-6">  
                  <input autocomplete="off" required id="password1" name="password1" class="form-control" type="password" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12 has-feedback">
                <label class="col-sm-6 control-label" for="password2">Repita Nueva Contraseña</label> 
                <div class="col-sm-6">  
                  <input data-match="#password1" data-match-error="*Las contraseñas no coinciden" autocomplete="off" required id="password2" name="password2" class="form-control" type="password" data-error="*Campo obligatorio">
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <button type="submit" class="pull-right btn btn-primary" style="margin-right:15px">Guardar</button>
          <button type="button" class="pull-right btn btn-default" style="margin-right:15px" data-dismiss="modal">Cancelar</button>
        </div>
        {!! Form::close() !!}
      </div>     
    </div>
  </div>
</div>
@stop

@section('content')
<div class="tab-content">
  @if (Session::get('alert') == 1)
  <div class="alert-group">
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <strong>Información</strong> La operación se ha realizado con éxito.
    </div>
  </div>
  @endif
  @if (Session::get('alert') == 2)
  <div class="alert-group">
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <strong>Error</strong> Contraseña incorrecta.
    </div>
  </div>
  @endif
  @if (count($errors) > 0)
  <div class="alert-group">
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      @foreach ($errors->all() as $error)
      {{ $error }}</br>
      @endforeach
    </div>
  </div>
  @endif
  <div class="panel-primary col-xs-12">
    <div class="panel-heading col-xs-12 form-inline">
      <h2 class="panel-title">Mi Cuenta</h2>
    </div>
    <div class="panel-body col-xs-12">
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Nombre</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ Auth::user()->nombre }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Apellido</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ Auth::user()->apellido }}</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Email</label> 
          <div class="col-md-8"> 
            <p class="form-control">{{ Auth::user()->email }}</p>
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label">Rol</label> 
          <div class="col-md-8">  
            <p class="form-control">{{ $rol }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="row">
      <a href="{{ route('perfil.edit', Auth::user()->id ) }}" class="pull-right btn btn-primary">Editar</a>
      <button style="margin-right:15px" class="pull-right btn btn-danger delete" data-toggle="modal" data-target="#UserDeleteModal" title="Eliminar">Eliminar</button>
      <button style="margin-right:15px" class="pull-right btn btn-warning delete" data-toggle="modal" data-target="#UserPasswordModal" title="Contraseña">Contraseña</button>
      <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
    </div>
  </div>
</div>
@stop