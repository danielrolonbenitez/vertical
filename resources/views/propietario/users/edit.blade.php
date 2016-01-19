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
  {!! Form::model($usuario, array('route' => array('users.update', $usuario->id), 'method' => 'PATCH', 'data-toggle' => 'validator')) !!}
    {{ csrf_field() }}
    <div class="panel-primary col-xs-12">
      <div class="panel-heading col-xs-12 form-inline">
        <div class="pull-left">
          <label style="font-size:20px;margin-bottom: 0px">Editar Usuario</label>
        </div>
      </div>
      <div class="panel-body col-xs-12">
        <div class="form-group col-md-6">
          <label class="col-md-offset-1 col-md-4 control-label" for="nombre">Nombre</label> 
          <div class="col-md-7"> 
            <input autocomplete="off" value="{{ $usuario->nombre }}" required id="nombre" name="nombre" class="form-control" type="text" data-error="*Campo obligatorio">
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="apellido">Apellido</label> 
          <div class="col-md-7">  
            <input autocomplete="off" value="{{ $usuario->apellido }}" required id="apellido" name="apellido" class="form-control" type="text" data-error="*Campo obligatorio">
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-offset-1 col-md-4 control-label" for="email">Email</label> 
          <div class="col-md-7"> 
            <input value="{{ $usuario->email }}" required id="email" name="email" class="form-control" type="email" data-error="*Campo obligatorio">
          </div>
        </div>
        <div class="form-group col-md-6">
          <label class="col-md-4 control-label" for="rol">Rol</label> 
          <div class="col-md-7">  
            <input disabled required value="{{ $rol->nombre }}" id="rol" name="rol" class="form-control" type="text" maxlength="10" data-error="*Campo obligatorio">
          </div>
        </div> 
         </div>
    </div>
    <div class="col-xs-12" style="padding-right:0px">
      <button type="submit" class="pull-right btn btn-primary">Guardar</button>
      <a href="javascript:history.back()" class="pull-right btn btn-default" style="margin-right:15px">Volver</a>
    </div>
  {!! Form::close() !!}
</div>
@stop